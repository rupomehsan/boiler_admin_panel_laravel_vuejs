<?php

use Illuminate\Support\Str;

if (!function_exists('Seeder')) {
    function Seeder($moduleName, $module_Name, $fields)
    {

        $formated_module = explode('/', $moduleName);
        if (count($formated_module) > 1) {
            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $formatField = [];
        if (count($fields)) {
            foreach ($fields as $field) {
                $formatField[] = [
                    $field[0] => $field[0]
                ];
            }
        }






        $content = <<<"EOD"
        <?php
        namespace App\\Modules\\Management\\{$moduleName}\\Seeder;

        use Illuminate\Database\Seeder as SeederClass;

        class Seeder extends SeederClass
        {
            /**
             * Run the database seeds.
             php artisan db:seed --class="\App\\Modules\\Management\\{$moduleName}\\Seeder\\Seeder"
             */
            static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;
            public function run(): void
            {

                self::\$model::truncate();
                for (\$i = 1; \$i < 100; \$i++) {
                self::\$model::create([

        EOD;
        if (count($formatField)) {
            foreach ($formatField as $fieldName => $rule) {
                if (is_array($rule)) {
                    foreach ($rule as $field => $value) {
                        $content .= "            '$field' => facker()->name,\n";
                    }
                }
            }
        }
        $content .= <<<EOD
                    ]);
                }
            }
        }
        EOD;
        return $content;
    }
}
