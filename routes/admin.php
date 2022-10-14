<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\RoleController;
use App\Http\controllers\Admin\AuthController;
use App\Http\controllers\Admin\ProductController;
use App\Http\controllers\Admin\DashboardController;
use App\Http\controllers\Admin\PermissionController;

// Auth route
Route::get('/login',           [AuthController::class, 'login'])->name('login');
Route::post('/login',          [AuthController::class, 'loginStore'])->name('login.store');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');

// Check auth
Route::middleware(['auth:admin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout',    [AuthController::class, 'logout'])->name('logout');
    // Role route
    Route::resource('roles', RoleController::class);
    // Permission route
    Route::resource('permissions', PermissionController::class);
    // Admin route
    Route::resource('products', ProductController::class);
    
    Route::get('/',              [AuthController::class, 'index'])->name('index');
    Route::get('/register',      [AuthController::class, 'register'])->name('register');
    Route::post('/register',     [AuthController::class, 'registerStore'])->name('register.store');
    Route::get('/{id}',          [AuthController::class, 'adminEdit'])->name('edit');
    Route::post('/destroy/{id}', [AuthController::class, 'adminDestroy'])->name('destroy');
    Route::post('/{id}',         [AuthController::class, 'adminUpdate'])->name('update');
});