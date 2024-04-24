<?php

use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;

Route::controller(AuditController::class)->prefix('logs')->name('logs.')->group(function () {
    Route::get('/', 'index')->name('index');
});
