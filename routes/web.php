<?php

use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/go-bag', 'go-bag')->name('go-bag');

Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist');
Route::post('/checklist/generate', [ChecklistController::class, 'generate'])
    ->name('checklist.generate');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';