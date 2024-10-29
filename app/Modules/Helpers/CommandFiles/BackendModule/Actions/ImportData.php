<?php

use Illuminate\Support\Str;

if (!function_exists('ImportData')) {
    function ImportData($moduleName, $fields)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\Management\\{$moduleName}\\Actions;

            class ImportData
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        foreach (request()->data as \$row) {
                             self::\$model::create([
            EOD;

        foreach ($fields as $field) {
            $content .= <<<EOD

                                "$field[0]" => \$row['$field[0]'],\n
            EOD;
        }

        $content .= <<<EOD

                            ]);
                        }
                        return messageResponse('Item Successfully updated', [], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}
