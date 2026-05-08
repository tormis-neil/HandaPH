<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ChecklistRuleController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Models\Feedback;
use App\Models\PreparednessTip;
use App\Models\SurveySubmission;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalQueries' => SurveySubmission::count(),
            'totalFeedback' => Feedback::count(),
            'activeTips' => PreparednessTip::where('is_active', true)->count(),
        ]);
    })->name('dashboard');

    Route::get('/api/analytics', [AnalyticsController::class, 'summary'])
        ->name('api.analytics');

    Route::get('/feedback', [FeedbackController::class, 'index'])
        ->name('feedback');

    // Register all 4 CRUD routes (index, store, update, destroy)
    Route::resource('checklist-rules', ChecklistRuleController::class)
        ->except(['create', 'show', 'edit'])
        ->parameters(['checklist-rules' => 'checklistRule']);
});
