<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $feedbacks = Feedback::latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => Feedback::count(),
            'effectiveness' => number_format(Feedback::avg('effectiveness') ?? 0, 1),
            'efficiency' => number_format(Feedback::avg('efficiency') ?? 0, 1),
            'satisfaction_usefulness' => number_format(Feedback::avg('satisfaction_usefulness') ?? 0, 1),
            'satisfaction_trust' => number_format(Feedback::avg('satisfaction_trust') ?? 0, 1),
            'satisfaction_pleasure' => number_format(Feedback::avg('satisfaction_pleasure') ?? 0, 1),
            'satisfaction_comfort' => number_format(Feedback::avg('satisfaction_comfort') ?? 0, 1),
            'risk_economic' => number_format(Feedback::avg('risk_economic') ?? 0, 1),
            'risk_health_safety' => number_format(Feedback::avg('risk_health_safety') ?? 0, 1),
            'risk_environmental' => number_format(Feedback::avg('risk_environmental') ?? 0, 1),
            'context_coverage' => number_format(Feedback::avg('context_coverage') ?? 0, 1),
            'flexibility' => number_format(Feedback::avg('flexibility') ?? 0, 1),
        ];

        return view('admin.feedback-management', compact('feedbacks', 'stats'));
    }

    public function exportPdf(): View
    {
        // Get ALL feedbacks for the PDF without pagination
        $feedbacks = Feedback::latest()->get();

        $stats = [
            'total' => Feedback::count(),
            'effectiveness' => number_format(Feedback::avg('effectiveness') ?? 0, 1),
            'efficiency' => number_format(Feedback::avg('efficiency') ?? 0, 1),
            'satisfaction_usefulness' => number_format(Feedback::avg('satisfaction_usefulness') ?? 0, 1),
            'satisfaction_trust' => number_format(Feedback::avg('satisfaction_trust') ?? 0, 1),
            'satisfaction_pleasure' => number_format(Feedback::avg('satisfaction_pleasure') ?? 0, 1),
            'satisfaction_comfort' => number_format(Feedback::avg('satisfaction_comfort') ?? 0, 1),
            'risk_economic' => number_format(Feedback::avg('risk_economic') ?? 0, 1),
            'risk_health_safety' => number_format(Feedback::avg('risk_health_safety') ?? 0, 1),
            'risk_environmental' => number_format(Feedback::avg('risk_environmental') ?? 0, 1),
            'context_coverage' => number_format(Feedback::avg('context_coverage') ?? 0, 1),
            'flexibility' => number_format(Feedback::avg('flexibility') ?? 0, 1),
        ];

        return view('admin.feedback-export', compact('feedbacks', 'stats'));
    }
}
