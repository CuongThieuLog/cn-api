<?php

use App\Http\Controllers\Admin\MovieFormatController;
use App\Http\Controllers\Admin\MovieTypeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\FacebookController;
use App\Http\Controllers\User\GoogleController;
use App\Http\Controllers\User\StripePaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

        Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
        Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');

        Route::get('facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
        Route::get('facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('refresh-token', [AuthController::class, 'refreshToken']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
            Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');
            Route::post('email/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
        });
    });

    Route::middleware('auth:sanctum')->prefix('payments')->group(function () {
        Route::get('stripe', [StripePaymentController::class, 'stripe']);
        Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    });
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin,manager,staff'])->group(function () {
        Route::apiResource('movie-type', MovieTypeController::class);
        Route::apiResource('movie-format', MovieFormatController::class);
    });
});