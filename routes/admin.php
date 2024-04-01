<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('pages.main-dashboard');
})->name('admin.dashboard');
