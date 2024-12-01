<?php

use Illuminate\Support\Str;

if (!function_exists('RouteContent')) {
    function RouteContent($moduleName, $class_name)
    {

        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $route_name = Str::plural((Str::kebab($class_name)));


        $content = <<<"EOD"
            <?php

            use App\\Modules\\Management\\{$moduleName}\\Controller\\Controller;
            use Illuminate\Support\Facades\Route;

            Route::prefix('v1')->group(function () {
                Route::prefix('{$route_name}')->group(function () {
                    Route::get('', [Controller::class,'index']);
                    Route::get('{slug}', [Controller::class,'show']);
                    Route::post('store', [Controller::class,'store']);
                    Route::post('update/{slug}', [Controller::class,'update']);
                    Route::post('update-status', [Controller::class,'updateStatus']);
                    Route::post('soft-delete', [Controller::class,'softDelete']);
                    Route::post('destroy/{slug}', [Controller::class,'destroy']);
                    Route::post('restore', [Controller::class,'restore']);
                    Route::post('import', [Controller::class,'import']);
                    Route::post('bulk-action', [Controller::class, 'bulkAction']);
                });
            });
            EOD;

        return $content;
    }
}
