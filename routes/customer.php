<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/update', 'update')->name('update');
        Route::patch('/update-password', 'updatePassword')->name('update-password');
        Route::patch('/update-address', 'updateAddress')->name('update-address');
        Route::delete('/delete', 'destroy')->name('destroy');
    });
});
