<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::prefix('/playground/shop')->name('shop.')->group(function () {
    Route::middleware(['guest'])->group(function() {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login.create');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->name('login.post');
        Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register.create');
        Route::post('/register', [RegisteredUserController::class, 'store'])
                ->name('register.store');
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    });
    Route::middleware(['auth'])->group(function() {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    });
});

Route::get('/dashboard', function () {
        return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.email');

// Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('password.reset');

// Route::post('/reset-password', [NewPasswordController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.update');

// Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
//                 ->middleware('auth')
//                 ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware(['auth', 'throttle:6,1'])
//                 ->name('verification.send');

                // add confirm page
// Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
//                 ->middleware('auth')
//                 ->name('password.confirm');

// Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
//                 ->middleware('auth');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//                 ->middleware('auth')
//                 ->name('logout');
