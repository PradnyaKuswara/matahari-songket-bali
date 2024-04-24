<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(AuditController::class)->prefix('logs')->name('logs.')->group(function () {
        Route::get('/', 'index')->name('index');
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
});
