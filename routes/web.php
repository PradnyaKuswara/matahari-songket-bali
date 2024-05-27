<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
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
    Route::get('detail/{product}', 'detailFront')->name('detailFront');
    Route::get('/categories-all', 'categoriesAll')->name('categoriesAll');
    Route::get('/categories-popular', 'categoriesPopular')->name('categoriesPopular');
    Route::get('/categories-oldest', 'categoriesOldest')->name('categoriesOldest');
    Route::get('/categories-cheapest', 'categoriesCheapest')->name('categoriesCheapest');
    Route::get('/categories-expansive', 'categoriesExpensive')->name('categoriesExpensive');
    Route::get('/search', 'searchFront')->name('search');
});

Route::controller(WhatsNewController::class)->prefix('whats-new')->name('whats-new.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('detail/{article}', 'detail')->name('detail');
});

Route::get('about', [AboutController::class, 'index'])->name('about');

Route::controller(CartController::class)->prefix('carts')->name('carts.')->middleware('customer')->group(function () {
    Route::get('/', 'indexFront')->name('indexFront');
    Route::get('/get-cart-by-customer', 'getCartByCustomer')->name('getCartByCustomer');
    Route::post('/store', 'storeCartByCustomer')->name('storeCartByCustomer');
    Route::patch('/update', 'updateCartByCustomer')->name('updateCartByCustomer');
    Route::delete('/delete', 'deleteCartByCustomer')->name('deleteCartByCustomer');
    Route::patch('/toggle', 'toggleCartByCustomer')->name('toggleCartByCustomer');
    Route::patch('/toggle-all', 'toggleCartByCustomerAll')->name('toggleCartByCustomerAll');
});

Route::controller(CheckOutController::class)->prefix('checkout')->name('checkout.')->middleware('customer')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::post('/check-stock', 'checkStock')->name('checkStock');

    Route::prefix('payment')->group(function () {
        Route::get('/{order}', 'showPayment')->name('showPayment');
        Route::get('/status/success', 'successView')->name('successView');
        Route::patch('/update/status', 'updateCheckout')->name('updateCheckout');
    });
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/invoice', function () {
        return view('pages.customer.transaction-invoice');
    })->name('invoice');
});

require __DIR__.'/mail-testing.php';
