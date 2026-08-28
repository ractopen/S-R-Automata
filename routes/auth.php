<?php

use App\Modules\Auth\Controllers\AuthenticatedSessionController;
use App\Modules\Auth\Controllers\ConfirmablePasswordController;
use App\Modules\Auth\Controllers\EmailVerificationNotificationController;
use App\Modules\Auth\Controllers\EmailVerificationPromptController;
use App\Modules\Auth\Controllers\PasswordController;
use App\Modules\Auth\Controllers\RegisteredUserController;
use App\Modules\Auth\Controllers\VerifyEmailController;
use App\Modules\Auth\Controllers\OtpResetController;
use App\Modules\Auth\Controllers\LoginOtpController;
use App\Modules\Auth\Controllers\RegistrationOtpController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('register/verify-otp', [RegistrationOtpController::class, 'showVerifyForm'])
        ->name('register.otp.verify');

    Route::post('register/verify-otp', [RegistrationOtpController::class, 'verify'])
        ->middleware('throttle:5,1')
        ->name('register.otp.submit');

    Route::post('register/resend-otp', [RegistrationOtpController::class, 'resend'])
        ->name('register.otp.resend');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('login/verify-otp', [LoginOtpController::class, 'showVerifyForm'])
        ->name('login.otp.verify');

    Route::post('login/verify-otp', [LoginOtpController::class, 'verify'])
        ->middleware('throttle:5,1')
        ->name('login.otp.submit');

    Route::get('forgot-password', [OtpResetController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [OtpResetController::class, 'store'])
        ->name('password.email');

    Route::get('verify-otp', [OtpResetController::class, 'showVerifyForm'])
        ->name('password.otp.verify');

    Route::post('verify-otp', [OtpResetController::class, 'reset'])
        ->middleware('throttle:5,1')
        ->name('password.otp.reset');

    Route::post('verify-otp/resend', [OtpResetController::class, 'resend'])
        ->name('password.otp.resend');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
