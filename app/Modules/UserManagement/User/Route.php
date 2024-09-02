<?php

use App\Modules\UserManagement\User\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('users', Controller::class);
    Route::post('users/bulk-action', [Controller::class, 'bulkAction']);
});