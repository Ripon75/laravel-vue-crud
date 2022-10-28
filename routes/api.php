<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Api\EmployeeDataController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login',    [AuthController::class, 'login'])->name('login');
    
Route::middleware('api')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::prefix('employees')->group(function() {
    Route::get('/countries',        [employeeDataController::class, 'country']);
    Route::get('/{country}/states', [employeeDataController::class, 'state']);
    Route::get('/{state}/cities',   [employeeDataController::class, 'city']);
    Route::get('/departments',      [employeeDataController::class, 'department']);
});

Route::get('/employees',               [EmployeeController::class, 'index']);
Route::post('/employees',              [EmployeeController::class, 'store']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);
Route::get('/employees/{employee}',    [EmployeeController::class, 'show']);
Route::post('/employees/{id}',         [EmployeeController::class, 'update']);

Route::get('/images',         [ImageController::class, 'index']);
Route::post('/images',        [ImageController::class, 'store']);
Route::delete('/images/{id}', [ImageController::class, 'destroy']);
Route::get('/images/{id}',    [ImageController::class, 'show']);
Route::post('/images/{id}',   [ImageController::class, 'update']);