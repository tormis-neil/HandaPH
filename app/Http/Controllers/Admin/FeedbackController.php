<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    private function getInterpretation($mean): string
    {
        if ($mean >= 4.50) return 'Highly Acceptable';
        if ($mean >= 3.50) return 'Acceptable';
        if ($mean >= 2.50) return 'Moderately Acceptable';
        if ($mean >= 1.50) return 'Slightly Acceptable';
        if ($mean >= 1.00) return 'Not Acceptable';
        return 'No Data';
    }

    private function calculateAnalytics($query)
    {
        $totalRespondents = $query->count();
        if ($totalRespondents === 0) {
            return null;
        }

        // 1. Calculate individual criterion means
        $criteria = [
            'effectiveness', 'efficiency', 
            'satisfaction_usefulness', 'satisfaction_trust', 'satisfaction_pleasure', 'satisfaction_comfort',
            'risk_economic', 'risk_health_safety', 'risk_environmental',
            'context_coverage', 'flexibility'
        ];

        $means = [];
        foreach ($criteria as $criterion) {
            $sum = $query->sum($criterion);
            $mean = $sum / $totalRespondents;
            $means[$criterion] = [
                'sum' => $sum,
                'mean' => round($mean, 2),
                'interpretation' => $this->getInterpretation($mean)
            ];
        }

        // 2. Calculate category means
        $categories = [
            'Effectiveness' => $means['effectiveness']['mean'],
            'Efficiency' => $means['efficiency']['mean'],
            'Satisfaction' => ($means['satisfaction_usefulness']['mean'] + $means['satisfaction_trust']['mean'] + $means['satisfaction_pleasure']['mean'] + $means['satisfaction_comfort']['mean']) / 4,
            'Freedom from Risk' => ($means['risk_economic']['mean'] + $means['risk_health_safety']['mean'] + $means['risk_environmental']['mean']) / 3,
            'Context Coverage' => $means['context_coverage']['mean'],
            'Flexibility' => $means['flexibility']['mean']
        ];

        foreach ($categories as $key => $val) {
            $categories[$key] = [
                'mean' => round($val, 2),
                'interpretation' => $this->getInterpretation($val)
            ];
        }

        // 3. Overall Mean
        $overallSum = 0;
        foreach ($categories as $cat) {
            $overallSum += $cat['mean'];
        }
        $overallMean = $overallSum / count($categories);

        return [
            'total' => $totalRespondents,
            'criteria' => $means,
            'categories' => $categories,
            'overall' => [
                'mean' => round($overallMean, 2),
                'interpretation' => $this->getInterpretation($overallMean)
            ]
        ];
    }

    public function index(Request $request): View
    {
        $query = Feedback::latest();

        // Apply Date Filter if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $feedbacks = $query->paginate(20)->withQueryString();
        
        // Clone query for analytics to ignore pagination limit
        $analyticsQuery = Feedback::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $analyticsQuery->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        
        $analytics = $this->calculateAnalytics($analyticsQuery);

        return view('admin.feedback-management', compact('feedbacks', 'analytics'));
    }

    public function exportPdf(Request $request): View
    {
        $query = Feedback::latest();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        $feedbacks = $query->get();

        $analyticsQuery = Feedback::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $analyticsQuery->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        $analytics = $this->calculateAnalytics($analyticsQuery);
        $isExcel = false;

        return view('admin.feedback-export', compact('feedbacks', 'analytics', 'isExcel'));
    }

    public function exportExcel(Request $request)
    {
        $query = Feedback::latest();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        $feedbacks = $query->get();

        $analyticsQuery = Feedback::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $analyticsQuery->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        $analytics = $this->calculateAnalytics($analyticsQuery);

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\FeedbackExport($feedbacks, $analytics),
            'handaph_feedback_evaluation_' . date('Y-m-d') . '.xlsx'
        );
    }
}
