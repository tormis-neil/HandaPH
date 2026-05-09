<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $myths = \App\Models\TyphoonMyth::where('is_active', true)->get();
    return view('home', compact('myths'));
})->name('home');

Route::get('/go-bag', function () {
    $categories = \App\Models\GoBagItem::where('is_active', true)
        ->get()
        ->groupBy('category');
    return view('go-bag', compact('categories'));
})->name('go-bag');


Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist');
Route::post('/checklist/generate', [ChecklistController::class, 'generate'])
    ->name('checklist.generate');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('feedback.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';