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

//main route

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

//route testing view email

Route::get('mail-invoice', function () {
    return view('mails.invoice');
})->name('mail-invoice');

Route::get('mail-purchase', function () {
    return view('mails.purchase');
})->name('mail-purchase');

Route::get('mail-shipped', function () {
    return view('mails.shipped');
})->name('mail-shipped');

Route::get('mail-accepted-product', function () {
    return view('mails.received-product');
})->name('mail-accepted-product');

Route::get('mail-invoice-pdf', 'App\Http\Controllers\MailController@viewTemplatePdf')->name('mail-invoice-pdf');

Route::post('send-mail-unpaid-invoice', 'App\Http\Controllers\MailController@sendInvoice')->name('send-mail-unpaid-invoice');
Route::post('send-mail-thank-purchase', 'App\Http\Controllers\MailController@sendThankPurchase')->name('send-mail-thank-purchase');
Route::post('send-mail-shipped', 'App\Http\Controllers\MailController@sendShipped')->name('send-mail-shipped');
Route::post('send-mail-received-product', 'App\Http\Controllers\MailController@sendReceived')->name('send-mail-received-product');
