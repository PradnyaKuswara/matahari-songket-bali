<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeaverController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(AuditController::class)->prefix('logs')->name('logs.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/update', 'update')->name('update');
        Route::patch('/update-password', 'updatePassword')->name('update-password');
        Route::patch('/update-address', 'updateAddress')->name('update-address');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::controller(ItemController::class)->prefix('items')->name('items.')->group(function () {
        Route::controller(ItemCategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{itemCategory}', 'edit')->name('edit');
            Route::patch('update/{itemCategory}', 'update')->name('update');
            Route::delete('delete/{itemCategory}', 'destroy')->name('destroy');
            Route::get('/search', 'search')->name('search');
        });
    });

    Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
        Route::controller(ProductCategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{productCategory}', 'edit')->name('edit');
            Route::patch('update/{productCategory}', 'update')->name('update');
            Route::delete('delete/{productCategory}', 'destroy')->name('destroy');
            Route::get('/search', 'search')->name('search');
        });
    });

    Route::controller(WeaverController::class)->prefix('weavers')->name('weavers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{weaver}', 'edit')->name('edit');
        Route::patch('update/{weaver}', 'update')->name('update');
        Route::delete('delete/{weaver}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });
});
