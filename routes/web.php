<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/go-bag', 'go-bag')->name('go-bag');

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist');
Route::post('/checklist/generate', [ChecklistController::class, 'generate'])
    ->name('checklist.generate');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('feedback.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';