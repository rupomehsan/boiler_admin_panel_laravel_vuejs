<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Backend\BackendController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::get('/super-admin', [BackendController::class, 'SuperAdminPanel'])->name('super.admin.dashboard');
