<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
*/


Route::get('/test', function () {
    dd("test something");
});
