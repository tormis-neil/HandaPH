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
        $query = Feedback::latest();

        if ($request->filled('rating') && $request->rating !== 'all') {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('region') && $request->region !== 'all') {
            $query->where('region', $request->region);
        }

        $feedbacks = $query->paginate(20)->withQueryString();

        $total = Feedback::count();
        $stats = [
            'avgRating' => number_format(Feedback::avg('rating') ?? 0, 1),
            'total' => $total,
            'veryEasyPercent' => $total > 0 
                ? round((Feedback::where('easy_to_understand', 'yes_very_easy')->count() / $total) * 100) 
                : 0,
        ];

        return view('admin.feedback-management', compact('feedbacks', 'stats'));
    }
}
