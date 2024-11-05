<?php

namespace App\Modules\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelingDirectory extends Command
{
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



        if ($withVue) {

            $role = 'SuperAdmin';
            $vueDirectory = resource_path("js/backend/Views/{$role}/Management/");
            $vue_format_dir = explode('/', $ViewModuleName);
            $vue_module_dir = null;

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



            $PagesDirectory = $vueDirectory . $ViewModuleName . '/pages';
            if (!File::isDirectory($PagesDirectory)) {
                File::makeDirectory($PagesDirectory);
            }
            $SetupDirectory = $vueDirectory . $ViewModuleName . '/setup';
            if (!File::isDirectory($SetupDirectory)) {
                File::makeDirectory($SetupDirectory);
            }
            $StoreDirectory = $vueDirectory . $ViewModuleName . '/store';
            if (!File::isDirectory($StoreDirectory)) {
                File::makeDirectory($StoreDirectory);
            }

            // dd($module_name);



            $setupActionFiles = ['form_fields.js',  'index.ts',  'routes.js', 'setup_type.ts'];
            $PagesFiles = ['All.vue', "Form.vue", "Details.vue", "Layout.vue"];
            $StoreFiles = ['index.ts',  'initial_state.ts'];

            foreach ($setupActionFiles as $file) {
                if ($file == 'form_fields.js') {
                    File::put($SetupDirectory . '/' . $file, FormField($fields));
                }
                if ($file == 'index.ts') {
                    File::put($SetupDirectory . '/' . $file, SetupIndex($ViewModuleName, $fields));
                }
                if ($file == 'routes.js') {
                    File::put($SetupDirectory . '/' . $file, Router());
                }
                if ($file == 'setup_type.ts') {
                    File::put($SetupDirectory . '/' . $file, SetupType());
                }
            }
            foreach ($PagesFiles as $file) {
                if ($file == 'All.vue') {
                    File::put($PagesDirectory . '/' . $file, AllDataPage($fields));
                }
                if ($file == 'Form.vue') {
                    File::put($PagesDirectory . '/' . $file, FormPage());
                }
                if ($file == 'Details.vue') {
                    File::put($PagesDirectory . '/' . $file, DetailsPage());
                }
                if ($file == 'Layout.vue') {
                    File::put($PagesDirectory . '/' . $file, LayoutPage());
                }
            }

            $sourceDirectory = base_path('app/Modules/Helpers/CommandFiles/FrontendModule/Store/actions');
            if (File::isDirectory($sourceDirectory)) {
                File::copyDirectory($sourceDirectory, $StoreDirectory);
            } else {
                echo "Source directory does not exist.";
            }

            foreach ($StoreFiles as $file) {
                if ($file == 'index.ts') {
                    File::put($StoreDirectory . '/' . $file, StoreIndex());
                }
                if ($file == 'initial_state.ts') {
                    File::put($StoreDirectory . '/' . $file, InitialState());
                }
            }

            $HelpersDirectory = $vueDirectory . $ViewModuleName . '/helpers';
            $sourceDirectory = base_path('app/Modules/Helpers/CommandFiles/FrontendModule/Helpers');

            if (!File::isDirectory($HelpersDirectory)) {
                File::makeDirectory($HelpersDirectory, 0755, true);
            }
            if (File::isDirectory($sourceDirectory)) {
                File::copyDirectory($sourceDirectory, $HelpersDirectory);
            } else {
                echo "Source directory does not exist.";
            }
        }
    }
}
