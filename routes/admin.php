<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');