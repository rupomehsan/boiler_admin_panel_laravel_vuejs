<?php

use App\Modules\Management\Auth\Controller\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [Controller::class, 'login']);
    Route::post('register', [Controller::class, 'register']);
    Route::post('send-otp', [Controller::class, 'SendOtp']);
    Route::post('verify-otp', [Controller::class, 'VerifyOtp']);
    Route::post('reset-password', [Controller::class, 'ResetPassword']);
});


Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('check_user', [Controller::class, 'checkUser']);
    Route::get('auth-check', [Controller::class, 'authCheck']);
});
