<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\employeeDataController;

Route::middleware('api')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('employee')->group(function() {
    Route::get('/countries',        [employeeDataController::class, 'country']);
    Route::get('/{country}/states', [employeeDataController::class, 'state']);
    Route::get('/{city}/cities',    [employeeDataController::class, 'city']);
    Route::get('/departments',      [employeeDataController::class, 'department']);
});

