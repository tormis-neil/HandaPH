<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/go-bag', 'go-bag')->name('go-bag');