<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        return view('feedback');
    }

    public function store(StoreFeedbackRequest $request): RedirectResponse
    {
        Feedback::create($request->validated());

        return redirect()
            ->route('feedback')
            ->with('success', 'Thank you for your feedback! Your response has been recorded.');
    }
}