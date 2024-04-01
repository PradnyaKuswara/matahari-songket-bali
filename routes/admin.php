<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.pages.main-dashboard');
})->name('admin.dashboard');