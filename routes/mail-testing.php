<?php

use Illuminate\Support\Facades\Route; //route testing view email

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

Route::get('send-whatsapp-message', 'App\Http\Controllers\MailController@sendWhatsAppMessage')->name('send-whatsapp-message');
