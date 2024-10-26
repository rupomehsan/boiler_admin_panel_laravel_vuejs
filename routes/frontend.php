<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| frontend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
