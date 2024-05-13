<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
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
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{item}', 'update')->name('update');
        Route::delete('delete/{item}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');

        Route::controller(ItemCategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('/search', 'search')->name('search');
        });
    });

    Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show', 'show')->name('show');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{product}', 'update')->name('update');
        Route::delete('delete/{product}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
        Route::patch('toggleActive/{product}', 'toggleActive')->name('toggleActive');

        Route::controller(ProductCategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::patch('update/{productCategory}', 'update')->name('update');
            Route::delete('delete/{productCategory}', 'destroy')->name('destroy');
            Route::get('/search', 'search')->name('search');
        });
    });

    Route::controller(WeaverController::class)->prefix('weavers')->name('weavers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{weaver}', 'update')->name('update');
        Route::patch('toggleActive/{weaver}', 'toggleActive')->name('toggleActive');
        Route::get('/search', 'search')->name('search');
    });

    Route::controller(CustomerController::class)->prefix('customers')->name('customers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{customer}', 'update')->name('update');
        Route::patch('toggleActive/{customer}', 'toggleActive')->name('toggleActive');
        Route::get('/search', 'search')->name('search');
        Route::get('/show-menu/{customer}', 'showMenu')->name('showMenu');
        Route::get('/show-address/{customer}', 'showAddress')->name('showAddress');
    });

    Route::controller(SellerController::class)->prefix('sellers')->name('sellers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{seller}', 'update')->name('update');
        Route::patch('toggleActive/{seller}', 'toggleActive')->name('toggleActive');
        Route::get('/search', 'search')->name('search');
    });

    Route::controller(ProductionController::class)->prefix('productions')->name('productions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{production}', 'edit')->name('edit');
        Route::patch('update/{production}', 'update')->name('update');
        Route::delete('delete/{production}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
        Route::get('/all-weaver-json', 'allWeaverJson')->name('allWeaverJson');
    });

    Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{article}', 'edit')->name('edit');
        Route::patch('update/{article}', 'update')->name('update');
        Route::patch('toggleActive/{article}', 'toggleActive')->name('toggleActive');
        Route::delete('delete/{article}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });
});
