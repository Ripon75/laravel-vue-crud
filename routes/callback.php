<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Callback\CallbackController;

// callback route for ssl
Route::match(['get', 'post'], '/payment/ssl/{type}', [CallbackController::class, 'SSLCallback'])->name('payment_ssl');