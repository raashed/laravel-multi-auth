<?php

use App\Http\Controllers\Api\Admin\Auth\ConfirmPasswordController as AdminConfirmPasswordController;
use App\Http\Controllers\Api\Admin\Auth\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Api\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Api\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Api\Admin\Auth\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\Api\Admin\Auth\VerificationController as AdminVerificationController;
use App\Http\Controllers\Api\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Api\Merchant\Auth\ConfirmPasswordController as MerchantConfirmPasswordController;
use App\Http\Controllers\Api\Merchant\Auth\ForgotPasswordController as MerchantForgotPasswordController;
use App\Http\Controllers\Api\Merchant\Auth\LoginController as MerchantLoginController;
use App\Http\Controllers\Api\Merchant\Auth\RegisterController as MerchantRegisterController;
use App\Http\Controllers\Api\Merchant\Auth\ResetPasswordController as MerchantResetPasswordController;
use App\Http\Controllers\Api\Merchant\Auth\VerificationController as MerchantVerificationController;
use App\Http\Controllers\Api\Merchant\HomeController as MerchantHomeController;
use App\Http\Controllers\Api\User\Auth\ConfirmPasswordController as UserConfirmPasswordController;
use App\Http\Controllers\Api\User\Auth\ForgotPasswordController as UserForgotPasswordController;
use App\Http\Controllers\Api\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Api\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Api\User\Auth\ResetPasswordController as UserResetPasswordController;
use App\Http\Controllers\Api\User\Auth\VerificationController as UserVerificationController;
use App\Http\Controllers\Api\User\HomeController as UserHomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Login Routes...
    Route::post('login', [AdminLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [AdminLoginController::class, 'logout']);
    // Registration Routes...
    Route::post('register', [AdminRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset']);
    // Password Confirmation Routes...
    Route::post('password/confirm', [AdminConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::post('email/resend', [AdminVerificationController::class, 'resend']);
    // After Login and Email Verified
    Route::middleware(['auth:admin-api', 'verified'])->group(function () {
        Route::get('/', [AdminHomeController::class, 'index']);
        Route::get('/home', [AdminHomeController::class, 'index']);
    });
});
Route::prefix('merchant')->group(function () {
    // Login Routes...
    Route::post('login', [MerchantLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [MerchantLoginController::class, 'logout']);
    // Registration Routes...
    Route::post('register', [MerchantRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::post('password/email', [MerchantForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [MerchantResetPasswordController::class, 'reset']);
    // Password Confirmation Routes...
    Route::post('password/confirm', [MerchantConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::post('email/resend', [MerchantVerificationController::class, 'resend']);
    // After Login and Email Verified
    Route::middleware(['auth:merchant-api', 'verified'])->group(function () {
        Route::get('/', [MerchantHomeController::class, 'index']);
        Route::get('/home', [MerchantHomeController::class, 'index']);
    });
});
Route::prefix('user')->group(function () {
    // Login Routes...
    Route::post('login', [UserLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [UserLoginController::class, 'logout']);
    // Registration Routes...
    Route::post('register', [UserRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::post('password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [UserResetPasswordController::class, 'reset']);
    // Password Confirmation Routes...
    Route::post('password/confirm', [UserConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::post('email/resend', [UserVerificationController::class, 'resend']);
    // After Login and Email Verified
    Route::middleware(['auth:user-api', 'verified'])->group(function () {
        Route::get('/', [UserHomeController::class, 'index']);
        Route::get('/home', [UserHomeController::class, 'index']);
    });
});
