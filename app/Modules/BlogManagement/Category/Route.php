<?php

use App\Modules\BlogManagement\Category\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', Controller::class);
    Route::post('categories/bulk-action', [Controller::class, 'bulkAction']);
});