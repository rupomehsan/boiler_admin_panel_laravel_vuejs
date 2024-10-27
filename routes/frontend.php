<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Controllers\Frontend\FrontendController;



/*
|--------------------------------------------------------------------------
| frontend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [FrontendController::class, 'login'])->name('login');
