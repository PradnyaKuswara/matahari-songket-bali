<?php

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

Route::get('/', function () {
    return view('pages.home');
})->name('index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('reset-password');

Route::get('products', function () {
    return view('pages.product');
})->name('products');

Route::get('product-detail', function () {
    return view('pages.product-detail');
})->name('product-detail');

Route::get('whats-new', function () {
    return view('pages.whats-new');
})->name('whats-new');

Route::get('whats-new-detail', function () {
    return view('pages.whats-new-detail');
})->name('whats-new-detail');

Route::get('about', function () {
    return view('pages.about');
})->name('about');

Route::get('cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('checkout', function () {
    return view('pages.checkout');
})->name('checkout');

Route::get('mail-invoice', function () {
    return view('mails.invoice-unpaid');
})->name('mail-invoice');

Route::post('send-mail-unpaid-invoice', 'App\Http\Controllers\MailController@sendUnpaidInvoice')->name('send-mail-unpaid-invoice');
