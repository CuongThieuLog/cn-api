<?php

// Admin
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\MovieFormatController as AdminMovieFormatController;
use App\Http\Controllers\Admin\MovieTypeController as AdminMovieTypeController;
use App\Http\Controllers\Admin\PersonController as AdminPersonController;
use App\Http\Controllers\Admin\PersonMovieController as AdminPersonMovieController;
use App\Http\Controllers\Admin\CinemaController as AdminCinemaController;

// User
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\MovieFormatController;
use App\Http\Controllers\User\MovieTypeController;
use App\Http\Controllers\User\PersonController;
use App\Http\Controllers\User\PersonMovieController;
use App\Http\Controllers\User\CinemaController;
use App\Http\Controllers\User\CommentController;

use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScreenController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TicketFoodController;
use App\Http\Controllers\Admin\TicketSeatController;
use App\Http\Controllers\User\FacebookController;
use App\Http\Controllers\User\GoogleController;
use App\Http\Controllers\User\PayPalController;
use App\Http\Controllers\User\StripePaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend', [AuthController::class, 'resendVerificationEmail']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);

        Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
        Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');

        Route::get('facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
        Route::get('facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('refresh-token', [AuthController::class, 'refreshToken']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });

    Route::middleware('auth:sanctum')->prefix('payments')->group(function () {
        Route::get('stripe', [StripePaymentController::class, 'stripe']);
        Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    });

    Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
    Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
    Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');

    Route::middleware(['auth:sanctum', 'role:user'])->as('user.')->group(function () {
        Route::apiResource('user', UserController::class)->only([]);
        Route::apiResource('movie', MovieController::class)->only(['index', 'show']);
        Route::apiResource('movie-format', MovieFormatController::class)->only(['index', 'show']);
        Route::apiResource('movie-type', MovieTypeController::class)->only(['index', 'show']);
        Route::apiResource('person', PersonController::class)->only(['index', 'show']);
        Route::apiResource('person-movie', PersonMovieController::class)->only(['index', 'show']);
        Route::apiResource('cinema', CinemaController::class)->only(['index', 'show']);
        Route::apiResource('comment', CommentController::class);
        Route::apiResource('comment', CommentController::class);
        Route::post('/comment/{commentId}/replies', [CommentController::class, 'storeReply']);
        Route::get('/comment/{commentId}/replies', [CommentController::class, 'showReplies']);
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AdminAuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('refresh-token', [AdminAuthController::class, 'refreshToken']);
            Route::post('logout', [AdminAuthController::class, 'logout']);
            Route::get('me', [AdminAuthController::class, 'me']);
        });
    });

    Route::middleware(['auth:sanctum', 'role:admin,manager,staff'])->as('admin.')->group(function () {
        Route::apiResource('user', AdminUserController::class);
        Route::apiResource('movie', AdminMovieController::class);
        Route::apiResource('movie-type', AdminMovieTypeController::class);
        Route::apiResource('movie-format', AdminMovieFormatController::class);
        Route::apiResource('person', AdminPersonController::class);
        Route::apiResource('person-movie', AdminPersonMovieController::class);
        Route::apiResource('cinema', AdminCinemaController::class);
        
        Route::apiResource('screen', ScreenController::class);
        Route::apiResource('food', FoodController::class);
        Route::apiResource('seat', SeatController::class);
        Route::apiResource('schedule', ScheduleController::class);
        Route::apiResource('ticket', TicketController::class);
        Route::apiResource('ticket-food', TicketFoodController::class);
        Route::apiResource('ticket-seat', TicketSeatController::class);
        Route::apiResource('comment', CommentController::class);
    });
});