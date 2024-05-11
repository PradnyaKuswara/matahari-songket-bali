<?php

use App\Http\Controllers\AddressController;
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

    Route::controller(AddressController::class)->prefix('address')->name('address.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::patch('/update/{address}', 'update')->name('update');
        Route::patch('/update-status/{address}', 'updateStatus')->name('update-status');
        Route::delete('/delete/{address}', 'destroy')->name('destroy');
    });
});
