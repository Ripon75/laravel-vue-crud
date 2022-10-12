<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\RoleController;
use App\Http\controllers\Admin\AuthController;
use App\Http\controllers\Admin\DashboardController;
use App\Http\controllers\Admin\PermissionController;

// Auth route
Route::get('/login',           [AuthController::class, 'login'])->name('login');
Route::post('/login',          [AuthController::class, 'loginStore'])->name('login.store');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');

// Check auth
Route::middleware(['auth:admin'])->group(function(){
    Route::get('/',          [AuthController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function() {
        Route::get('/register',  [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
        Route::get('/{id}',      [AuthController::class, 'adminEdit'])->name('edit');
        Route::post('/destroy',  [AuthController::class, 'destroy'])->name('destroy');
        Route::post('/{id}',     [AuthController::class, 'adminUpdate'])->name('update');
        Route::get('/logout',    [AuthController::class, 'logout'])->name('logout');
        // Role route
        Route::resource('roles', RoleController::class);
        // Permission route
        Route::resource('permissions', PermissionController::class);
    });
});