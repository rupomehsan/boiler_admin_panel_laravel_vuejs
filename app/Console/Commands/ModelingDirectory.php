<?php

namespace App\Console\Commands;

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



        $baseDirectory = app_path("Modules/");
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

        $actionFiles = ['All.php', 'BulkActions.php', 'Store.php', 'Show.php', 'Update.php', 'Delete.php',  'Validation.php', 'Seeder.php'];

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

        // dd($module_name);
        foreach ($actionFiles as $file) {
            if ($file == 'All.php') {
                File::put($actionsDirectory . '/' . $file, all($module_name));
            }
            if ($file == 'BulkActions.php') {
                File::put($actionsDirectory . '/' . $file, bulkActions($module_name));
            }
            if ($file == 'Store.php') {
                File::put($actionsDirectory . '/' . $file, store($module_name));
            }
            if ($file == 'Show.php') {
                File::put($actionsDirectory . '/' . $file, show($module_name));
            }
            if ($file == 'Update.php') {
                File::put($actionsDirectory . '/' . $file, update($module_name));
            }
            if ($file == 'Delete.php') {
                File::put($actionsDirectory . '/' . $file, delete($module_name));
            }
            if ($file == 'Validation.php') {
                File::put($ValidationDirectory . '/' . $file, validation($module_name, $fields));
            }
        }

        File::put($baseDirectory . $moduleName . '/Controller.php', controller($module_name));
        File::put($baseDirectory . $moduleName . '/Models/Model.php', model($module_name, $moduleName));
        File::put($baseDirectory . $moduleName . '/Database/create_' . $table . '_table.php', migration($module_name, $fields));
        File::put($baseDirectory . $moduleName . '/Route.php', routeContent($module_name, $moduleName));
        File::put($baseDirectory . $moduleName . '/api.http', api($moduleName));
        File::put($baseDirectory . $moduleName . '/Database/Seeder.php', seeder($module_name, $moduleName, $fields));



        if ($withVue) {

            $role = 'admin';
            $vueDirectory = resource_path("js/backend/views/pages/{$role}/management/");
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


            $ViewactionsDirectory = $vueDirectory . $ViewModuleName . '/setup';
            if (!File::isDirectory($ViewactionsDirectory)) {
                File::makeDirectory($ViewactionsDirectory);
            }

            // dd($module_name);

            File::put($vueDirectory  . $ViewModuleName . '/All.vue', viewAll($ViewModuleName,$fields));
            File::put($vueDirectory  . $ViewModuleName . '/Form.vue', viewForm($ViewModuleName));

            $setupActionFiles = ['form_fields.js',  'index.js', 'Layout.vue', 'routes.js', 'store.js'];
            foreach ($setupActionFiles as $file) {
                if ($file == 'form_fields.js') {
                    File::put($ViewactionsDirectory . '/' . $file, ViewFormField($ViewModuleName, $fields));
                }
                if ($file == 'index.js') {
                    File::put($ViewactionsDirectory . '/' . $file, ViewIndex($ViewModuleName, $role));
                }
                if ($file == 'Layout.vue') {
                    File::put($ViewactionsDirectory . '/' . $file, ViewLayout($ViewModuleName));
                }
                if ($file == 'routes.js') {
                    File::put($ViewactionsDirectory . '/' . $file, ViewRoute($ViewModuleName));
                }
                if ($file == 'store.js') {
                    File::put($ViewactionsDirectory . '/' . $file, ViewStore($ViewModuleName));
                }
            }
        }
    }
}
