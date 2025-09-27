<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('/otp', [AuthController::class, 'showOTPForm'])->name('otp.login');
    Route::post('/otp/request', [AuthController::class, 'requestCode'])->name('otp.request');
    Route::post('/otp/verify', [AuthController::class, 'verify'])->name('otp.verify');

});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', function () {
        return "Welcome to your dashboard!";
    })->name('dashboard');

});
