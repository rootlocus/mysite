<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//display a notice to the user that they should click the email verification link 
Route::get('/email/verify', function () {
    return Inertia::render('Playground/Shop/Auth/EmailVerified');
})->middleware('auth')->name('verification.notice');

//user clicks the email verification link that was emailed to them
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/playground/shop/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

// user may misplace or accidentally delete the email address verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:3,60'])->name('verification.send');

//Forget Password
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// https://laravel.com/docs/8.x/verification
// Route::get('/profile', function () {
//     // Only verified users may access this route...
// })->middleware('verified');
