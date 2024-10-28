<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Frontend\FrontendController;
use App\Modules\Controllers\Frontend\Auth\AuthController;



Route::get('/', [FrontendController::class, 'HomePage'])->name('HomePage');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::get('/forgot-password', [AuthController::class, 'ForgotPassword'])->name('ForgotPassword');
Route::get('/verify-code', [AuthController::class, 'VerifyCode'])->name('VerifyCode');
Route::get('/reset-password', [AuthController::class, 'ResetPassword'])->name('ResetPassword');
