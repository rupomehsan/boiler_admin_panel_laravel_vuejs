<?php

namespace App\Modules\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelingDirectory extends Command
{
    // protected $signature = 'make:module {module_name} {[field]?} {--vue} {--m} {--seed}';
    protected $signature = 'make:module {module_name} {[field]?} {--vue}';
    protected $description = 'Create a folder and files in the app directory';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $moduleName = $this->argument('module_name');
        $ViewModuleName = $this->argument('module_name');
        $withVue = $this->option('vue');
        // $migration = $this->option('m');
        // $seed = $this->option('seed');
        $fields = [];



        // Check if the field argument is provided
        if ($this->hasArgument('[field]') && $this->argument('[field]')) {
            $fieldName = $this->argument('[field]');
            $fieldName = str_replace('[', '', $fieldName);
            $fieldName = str_replace(']', '', $fieldName);
            $fieldName = explode(',', $fieldName);
            foreach ($fieldName as $item) {
                $fields[] =  explode(':', $item);
            }
        }





        $baseDirectory = app_path("Modules/Management/");
        $format_dir = explode('/', $moduleName);
        $module_dir = null;

        if (count($format_dir) > 1) {
            $moduleName = end($format_dir);
            array_pop($format_dir); //if do not make last name folder
            $module_dir = implode('/', $format_dir);
            if (!File::isDirectory($baseDirectory . $module_dir)) {
                mkdir($baseDirectory . $module_dir, 0777, true);
            }
            $baseDirectory = $baseDirectory . $module_dir . '/';
        }

        $table = Str::plural((Str::snake($moduleName)));



        if (!File::isDirectory($baseDirectory . $moduleName)) {
            File::makeDirectory($baseDirectory . $moduleName);
        }



        $actionsDirectory = $baseDirectory . $moduleName . '/Actions';
        if (!File::isDirectory($actionsDirectory)) {
            File::makeDirectory($actionsDirectory);
        }

        $migrationtable = 'create_' . $table . '_table.php';

        $actionFiles = [

            'GetAllData.php',
            'BulkActions.php',
            'StoreData.php',
            'GetSingleData.php',
            'UpdateData.php',
            'UpdateStatus.php',
            'DestroyData.php',
            'RestoreData.php',
            'SoftDelete.php',
            'ImportData.php',

            'DataStoreValidation.php',
            'BulkActionsValidation.php',

            'Controller.php',

            'Model.php',
            $migrationtable,
            'Seeder.php',

            'Route.php',
            'Api.http',
            'ImportJob.php',
            'Doc.txt',

        ];

        if ($module_dir != null) {
            $module_name = $module_dir . '/' . $moduleName;
        } else {
            $module_name = $moduleName;
        }



        $ValidationDirectory = $baseDirectory . $moduleName . '/Validations';
        if (!File::isDirectory($ValidationDirectory)) {
            File::makeDirectory($ValidationDirectory);
        }



        $ModelDirectory = $baseDirectory . $moduleName . '/Models';
        if (!File::isDirectory($ModelDirectory)) {
            File::makeDirectory($ModelDirectory);
        }

        $DatabaseDirectory = $baseDirectory . $moduleName . '/Database';
        if (!File::isDirectory($DatabaseDirectory)) {
            File::makeDirectory($DatabaseDirectory);
        }
        $ControllerDirectory = $baseDirectory . $moduleName . '/Controller';
        if (!File::isDirectory($ControllerDirectory)) {
            File::makeDirectory($ControllerDirectory);
        }
        $OthersDirectory = $baseDirectory . $moduleName . '/Others';
        if (!File::isDirectory($OthersDirectory)) {
            File::makeDirectory($OthersDirectory);
        }
        $RoutesDirectory = $baseDirectory . $moduleName . '/Routes';
        if (!File::isDirectory($RoutesDirectory)) {
            File::makeDirectory($RoutesDirectory);
        }
        $SeederDirectory = $baseDirectory . $moduleName . '/Seeder';
        if (!File::isDirectory($SeederDirectory)) {
            File::makeDirectory($SeederDirectory);
        }




        foreach ($actionFiles as $file) {
            if ($file == 'GetAllData.php') {
                File::put($actionsDirectory . '/' . $file, GetAllData($module_name, $fields));
            }

            if ($file == 'StoreData.php') {
                File::put($actionsDirectory . '/' . $file, StoreData($module_name));
            }
            if ($file == 'GetSingleData.php') {
                File::put($actionsDirectory . '/' . $file, GetSingleData($module_name));
            }
            if ($file == 'UpdateData.php') {
                File::put($actionsDirectory . '/' . $file, UpdateData($module_name));
            }
            if ($file == 'UpdateStatus.php') {
                File::put($actionsDirectory . '/' . $file, UpdateStatus($module_name));
            }
            if ($file == 'DestroyData.php') {
                File::put($actionsDirectory . '/' . $file, DestroyData($module_name));
            }
            if ($file == 'BulkActions.php') {
                File::put($actionsDirectory . '/' . $file, BulkActions($module_name));
            }
            if ($file == 'SoftDelete.php') {
                File::put($actionsDirectory . '/' . $file, SoftDelete($module_name));
            }
            if ($file == 'ImportData.php') {
                File::put($actionsDirectory . '/' . $file, ImportData($module_name, $fields));
            }
            if ($file == 'RestoreData.php') {
                File::put($actionsDirectory . '/' . $file, RestoreData($module_name));
            }


            if ($file == 'DataStoreValidation.php') {
                File::put($ValidationDirectory . '/' . $file, DataStoreValidation($module_name, $fields));
            }

            if ($file == 'BulkActionsValidation.php') {
                File::put($ValidationDirectory . '/' . $file, BulkActionsValidation($module_name, $fields));
            }


            if ($file == 'Controller.php') {
                File::put($ControllerDirectory . '/' . $file, Controller($module_name, $fields));
            }

            if ($file == 'Model.php') {
                File::put($ModelDirectory . '/' . $file, Model($module_name, $moduleName));
            }
            if ($file == $migrationtable) {
                File::put($DatabaseDirectory . '/' . $file, Migration($module_name, $fields));
            }


            if ($file == 'Route.php') {
                File::put($RoutesDirectory . '/' . $file, RouteContent($module_name, $moduleName));
            }
            if ($file == 'Api.http') {
                File::put($OthersDirectory . '/' . $file, ApiDocumentation($moduleName));
            }
            if ($file == 'Doc.txt') {
                File::put($OthersDirectory . '/' . $file, Documentation());
            }
            if ($file == 'ImportJob.php') {
                File::put($OthersDirectory . '/'  . $file, ImportJob($moduleName));
            }
            if ($file == 'Seeder.php') {
                File::put($SeederDirectory . '/' . $file, Seeder($module_name, $moduleName, $fields));
            }
        }

        if (true) {
            $table_name = '';
            $formated_module = explode('/', $moduleName);
            if (count($formated_module) > 1) {
                $moduleName = implode('/', $formated_module);
                $moduleName = Str::replace("/", "\\", $moduleName);
                $table_name = Str::plural((Str::snake($formated_module[count($formated_module) - 1])));
            } else {
                $table_name = Str::plural((Str::snake($moduleName)));
                $moduleName = Str::replace("/", "\\", $moduleName);
            }

            $migrationPath = "\App\\Modules\\Management\\{$ViewModuleName}\\Database\\create_{$table_name}_table.php";
            Artisan::call('migrate', ['--path' => $migrationPath]);
        }

        if (true) {
            $SeederDirectory = $ViewModuleName;
            $formated_module = explode('/', $SeederDirectory);
            if (count($formated_module) > 1) {
                $SeederDirectory = implode('/', $formated_module);
                $SeederDirectory = Str::replace("/", "\\", $SeederDirectory);
            } else {
                $SeederDirectory = Str::replace("/", "\\", $SeederDirectory);
            }

            $seederPath = "\App\\Modules\\Management\\{$SeederDirectory}\\Seeder\\Seeder";
            Artisan::call('db:seed', ['--class' => $seederPath]);
        }



        $filePath = base_path("app/Modules/Routes/ApiRoutes.php");
        $newRoute = "include_once base_path(\"app/Modules/Management/{$ViewModuleName}/Routes/Route.php\");\n";
        if (strpos(file_get_contents($filePath), $newRoute) === false) {
            file_put_contents($filePath, $newRoute, FILE_APPEND);
        }






        if ($withVue) {

            $role = 'SuperAdmin';
            $vueDirectory = resource_path("js/backend/Views/{$role}/Management/");
            $vue_format_dir = explode('/', $ViewModuleName);
            $vue_module_dir = null;
            $vue_module_path_dir = $ViewModuleName;




            if (count($vue_format_dir) > 1) {
                $ViewModuleName = end($vue_format_dir);
                array_pop($vue_format_dir);
                $vue_module_dir = implode('/', $vue_format_dir);

                if (!File::isDirectory($vueDirectory . $vue_module_dir)) {
                    mkdir($vueDirectory . $vue_module_dir, 0777, true);
                }

                $vueDirectory = $vueDirectory . $vue_module_dir . '/';
            }

            if (!File::isDirectory($vueDirectory . $ViewModuleName)) {
                File::makeDirectory($vueDirectory . $ViewModuleName);
            }





            $viewSourceFileDirectory = $vueDirectory . $ViewModuleName;
            $sourceDirectory = base_path('app/Modules/Helpers/CommandFiles/FrontendModule/Source');

            if (!File::isDirectory($viewSourceFileDirectory)) {
                File::makeDirectory($viewSourceFileDirectory, 0755, true);
            }
            if (File::isDirectory($sourceDirectory)) {
                File::copyDirectory($sourceDirectory, $viewSourceFileDirectory);
            } else {
                echo "Source directory does not exist.";
            }

            $SetupDirectory = $vueDirectory . $ViewModuleName . '/setup';
            if (!File::isDirectory($SetupDirectory)) {
                File::makeDirectory($SetupDirectory);
            }
            $setupActionFiles = ['form_fields.js',  'index.ts'];

            foreach ($setupActionFiles as $file) {
                if ($file == 'form_fields.js') {
                    File::put($SetupDirectory . '/' . $file, FormField($fields));
                }
                if ($file == 'index.ts') {
                    File::put($SetupDirectory . '/' . $file, SetupIndex($vue_module_path_dir, $fields));
                }
            }


            //dynamic roter link making
            //dynamic roter link making


            $filePath = base_path("resources/js/backend/Views/{$role}/Routes/routes.js");
            $routeImport = "import {$ViewModuleName}Routes from '../Management/{$vue_module_path_dir}/setup/routes.js';\n";
            $newRouteChild = "        {$ViewModuleName}Routes,\n";
            $fileContent = file_get_contents($filePath);

            // Insert import statement if it doesn't already exist
            if (strpos($fileContent, $routeImport) === false) {
                $importPosition = strpos($fileContent, "//routes");
                if ($importPosition !== false) {
                    $insertPosition = $importPosition + strlen("//routes") + 1; // Position after "//routes" + newline
                    $fileContent = substr_replace($fileContent, $routeImport, $insertPosition, 0);
                }
            }

            // Insert route child if it doesn't already exist
            if (strpos($fileContent, $newRouteChild) === false) {
                $managementRoutesPosition = strpos($fileContent, "//management routes");
                if ($managementRoutesPosition !== false) {
                    $insertPosition = $managementRoutesPosition + strlen("//management routes") + 1; // Position after "//management routes" + newline
                    $fileContent = substr_replace($fileContent, $newRouteChild, $insertPosition, 0);
                }
            }

            // Write the modified content back to the file
            file_put_contents($filePath, $fileContent);


            //sidebar dynamic  making
            //sidebar dynamic  making

            $filePath = base_path("resources/js/backend/Views/{$role}/Layouts/Partials/Sidebar/Index.vue");
            $sidebarMenuContent = "<side-bar-single-menu :icon=\"`fa fa-plus`\" :menu_title=\"`{$ViewModuleName}`\"  :route_name=\"`All{$ViewModuleName}`\" />\n";


            $fileContent = file_get_contents($filePath);


            if (strpos($fileContent, $routeImport) === false) {
                $routesCommentPosition = strpos($fileContent, "<!-- Management start -->");
                $insertPosition = strpos($fileContent, "\n", $routesCommentPosition) + 1;
                $fileContent = substr($fileContent, 0, $insertPosition)  . substr($fileContent, $insertPosition);
            }

            if (strpos($fileContent, $sidebarMenuContent) === false) {
                $managementEndPosition = strpos($fileContent, "<!-- Management end -->");
                $fileContent = substr($fileContent, 0, $managementEndPosition) . $sidebarMenuContent . substr($fileContent, $managementEndPosition);
            }
            file_put_contents($filePath, $fileContent);
        }
    }
}
