<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/go-bag', 'go-bag')->name('go-bag');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';