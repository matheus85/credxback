<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackingController;

Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('auth:api')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout']);
    
    Route::apiResource('trackings', TrackingController::class);
});
