<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WhatsNewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//main route

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'indexFront')->name('indexFront');
    Route::get('detail', 'detailFront')->name('detailFront');
});

Route::controller(WhatsNewController::class)->prefix('whats-new')->name('whats-new.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('detail', 'detail')->name('detail');
});

Route::get('about', [AboutController::class, 'index'])->name('about');

Route::get('cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('checkout', function () {
    return view('pages.checkout');
})->name('checkout');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/invoice', function () {
        return view('pages.customer.transaction-invoice');
    })->name('invoice');
});

require __DIR__.'/mail-testing.php';
