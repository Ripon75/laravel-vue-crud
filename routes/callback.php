<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Callback\CallbackController;

// callback route for ssl
Route::match(['get', 'post'], '/payment/ssl/{type}', [CallbackController::class, 'SSLCallback'])->name('ssl.payment');

// callback route for bKash
Route::match(['get', 'post'], '/payment/bkash', [CallbackController::class, 'bkashCallback'])->name('bkash.payment');