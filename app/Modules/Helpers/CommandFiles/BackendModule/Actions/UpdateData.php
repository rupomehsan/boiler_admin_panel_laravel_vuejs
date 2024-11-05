<?php

use Illuminate\Support\Str;

if (!function_exists('UpdateData')) {
    function UpdateData($moduleName)
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

            class UpdateData
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$request,\$slug)
                {
                    try {
                        if (!\$data = self::\$model::query()->where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...',\$data, 404, 'error');
                        }
                        \$requestData = \$request->validated();
                        \$data->update(\$requestData);
                        return messageResponse('Item updated successfully',\$data, 201);
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
