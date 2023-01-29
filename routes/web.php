<?php

use App\Http\Controllers\Web\Admin\Auth\ConfirmPasswordController as AdminConfirmPasswordController;
use App\Http\Controllers\Web\Admin\Auth\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Web\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Web\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Web\Admin\Auth\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\Web\Admin\Auth\VerificationController as AdminVerificationController;
use App\Http\Controllers\Web\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Web\Merchant\Auth\ConfirmPasswordController as MerchantConfirmPasswordController;
use App\Http\Controllers\Web\Merchant\Auth\ForgotPasswordController as MerchantForgotPasswordController;
use App\Http\Controllers\Web\Merchant\Auth\LoginController as MerchantLoginController;
use App\Http\Controllers\Web\Merchant\Auth\RegisterController as MerchantRegisterController;
use App\Http\Controllers\Web\Merchant\Auth\ResetPasswordController as MerchantResetPasswordController;
use App\Http\Controllers\Web\Merchant\Auth\VerificationController as MerchantVerificationController;
use App\Http\Controllers\Web\Merchant\HomeController as MerchantHomeController;
use App\Http\Controllers\Web\User\Auth\ConfirmPasswordController as UserConfirmPasswordController;
use App\Http\Controllers\Web\User\Auth\ForgotPasswordController as UserForgotPasswordController;
use App\Http\Controllers\Web\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Web\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Web\User\Auth\ResetPasswordController as UserResetPasswordController;
use App\Http\Controllers\Web\User\Auth\VerificationController as UserVerificationController;
use App\Http\Controllers\Web\User\HomeController as UserHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    // Login Routes...
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    // Registration Routes...
    Route::get('register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
    // Password Confirmation Routes...
    Route::get('password/confirm', [AdminConfirmPasswordController::class, 'showConfirmForm'])->name('admin.password.confirm');
    Route::post('password/confirm', [AdminConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::get('email/verify', [AdminVerificationController::class, 'show'])->name('admin.verification.notice');
    Route::get('email/verify/{id}/{hash}', [AdminVerificationController::class, 'verify'])->name('admin.verification.verify');
    Route::post('email/resend', [AdminVerificationController::class, 'resend'])->name('admin.verification.resend');
    // After Login and Email Verified
    Route::middleware(['auth:admin', 'verified'])->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
        Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');
    });
});
Route::prefix('merchant')->group(function () {
    // Login Routes...
    Route::get('login', [MerchantLoginController::class, 'showLoginForm'])->name('merchant.login');
    Route::post('login', [MerchantLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [MerchantLoginController::class, 'logout'])->name('merchant.logout');
    // Registration Routes...
    Route::get('register', [MerchantRegisterController::class, 'showRegistrationForm'])->name('merchant.register');
    Route::post('register', [MerchantRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::get('password/reset', [MerchantForgotPasswordController::class, 'showLinkRequestForm'])->name('merchant.password.request');
    Route::post('password/email', [MerchantForgotPasswordController::class, 'sendResetLinkEmail'])->name('merchant.password.email');
    Route::get('password/reset/{token}', [MerchantResetPasswordController::class, 'showResetForm'])->name('merchant.password.reset');
    Route::post('password/reset', [MerchantResetPasswordController::class, 'reset'])->name('merchant.password.update');
    // Password Confirmation Routes...
    Route::get('password/confirm', [MerchantConfirmPasswordController::class, 'showConfirmForm'])->name('merchant.password.confirm');
    Route::post('password/confirm', [MerchantConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::get('email/verify', [MerchantVerificationController::class, 'show'])->name('merchant.verification.notice');
    Route::get('email/verify/{id}/{hash}', [MerchantVerificationController::class, 'verify'])->name('merchant.verification.verify');
    Route::post('email/resend', [MerchantVerificationController::class, 'resend'])->name('merchant.verification.resend');
    // After Login and Email Verified
    Route::middleware(['auth:merchant', 'verified'])->group(function () {
        Route::get('/', [MerchantHomeController::class, 'index'])->name('merchant.home');
        Route::get('/home', [MerchantHomeController::class, 'index'])->name('merchant.home');
    });
});
Route::prefix('user')->group(function () {
    // Login Routes...
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserLoginController::class, 'login']);
    // Logout Routes...
    Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');
    // Registration Routes...
    Route::get('register', [UserRegisterController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('register', [UserRegisterController::class, 'register']);
    // Password Reset Routes...
    Route::get('password/reset', [UserForgotPasswordController::class, 'showLinkRequestForm'])->name('user.password.request');
    Route::post('password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.password.email');
    Route::get('password/reset/{token}', [UserResetPasswordController::class, 'showResetForm'])->name('user.password.reset');
    Route::post('password/reset', [UserResetPasswordController::class, 'reset'])->name('user.password.update');
    // Password Confirmation Routes...
    Route::get('password/confirm', [UserConfirmPasswordController::class, 'showConfirmForm'])->name('user.password.confirm');
    Route::post('password/confirm', [UserConfirmPasswordController::class, 'confirm']);
    // Email Verification Routes...
    Route::get('email/verify', [UserVerificationController::class, 'show'])->name('user.verification.notice');
    Route::get('email/verify/{id}/{hash}', [UserVerificationController::class, 'verify'])->name('user.verification.verify');
    Route::post('email/resend', [UserVerificationController::class, 'resend'])->name('user.verification.resend');
    // After Login and Email Verified
    Route::middleware(['auth:user', 'verified'])->group(function () {
        Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
        Route::get('/home', [UserHomeController::class, 'index'])->name('user.home');
    });
});
