<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\AuthController;
use App\Http\controllers\Admin\DashboardController;

// Auth route
Route::get('/login',           [AuthController::class, 'login'])->name('login');
Route::get('/register',        [AuthController::class, 'register'])->name('register');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/admins',          [AuthController::class, 'getAdmin'])->name('index');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');