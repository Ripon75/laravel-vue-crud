<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\DashboardController;

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
