<?php

namespace App\Exports;

use App\Models\Feedback;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FeedbackExport implements FromView, ShouldAutoSize
{
    protected $feedbacks;
    protected $analytics;

    public function __construct($feedbacks, $analytics)
    {
        $this->feedbacks = $feedbacks;
        $this->analytics = $analytics;
    }

    public function view(): View
    {
        return view('admin.feedback-export', [
            'feedbacks' => $this->feedbacks,
            'analytics' => $this->analytics,
            'isExcel' => true
        ]);
    }
}
