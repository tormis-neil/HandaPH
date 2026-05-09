<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\GoBagItemController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ChecklistRuleController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\TyphoonMythController;
use App\Models\Feedback;
use App\Models\TyphoonMyth;
use App\Models\SurveySubmission;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalQueries' => SurveySubmission::count(),
            'totalFeedback' => Feedback::count(),
            'activeTips' => TyphoonMyth::where('is_active', true)->count(),
        ]);
    })->name('dashboard');

    Route::get('/api/analytics', [AnalyticsController::class, 'summary'])
        ->name('api.analytics');

    Route::get('/feedback', [FeedbackController::class, 'index'])
        ->name('feedback');

    Route::resource('checklist-rules', ChecklistRuleController::class)
        ->except(['create', 'show', 'edit'])
        ->parameters(['checklist-rules' => 'checklistRule']);

    // Register all 4 CRUD routes for Typhoon Myths
    Route::resource('typhoon-myths', TyphoonMythController::class)
        ->except(['create', 'show', 'edit'])
        ->parameters(['typhoon-myths' => 'typhoonMyth']);

    // Register all 4 CRUD routes for Go-Bag items
    Route::resource('go-bag-items', GoBagItemController::class)
        ->except(['create', 'show', 'edit'])
        ->parameters(['go-bag-items' => 'goBagItem']);

    // Admin Account Settings
    Route::get('/account', [AdminAccountController::class, 'edit'])->name('account');
    Route::put('/account/profile', [AdminAccountController::class, 'updateProfile'])->name('account.profile');
    Route::put('/account/password', [AdminAccountController::class, 'updatePassword'])->name('account.password');
    Route::delete('/account', [AdminAccountController::class, 'destroy'])->name('account.destroy');

});
