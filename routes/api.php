<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\GoogleController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::get('auth/google/callback',  [GoogleController::class, 'handleGoogleCallback']);
    Route::get('auth/google',  [GoogleController::class, 'redirectToGoogle']);

    Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
        Route::post('refresh-token', [AuthController::class, 'refreshToken']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::prefix('admin')->group(function () {
   
});