<?php

use Illuminate\Support\Str;

if (!function_exists('GetSingleData')) {
    function GetSingleData($moduleName)
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



            class GetSingleData
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$slug)
                {
                    try {
                        \$with = [];
                        \$fields = request()->input('fields') ?? ['*'];
                        if (!\$data = self::\$model::query()->with(\$with)->select(\$fields)->where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...',\$data, 404, 'error');
                        }
                        return entityResponse(\$data);
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        // $content = str_replace('{moduleName}', $moduleName, $content);
        return $content;
    }
}
