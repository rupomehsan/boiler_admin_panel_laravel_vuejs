<?php

use Illuminate\Support\Str;

if (!function_exists('UpdateStatus')) {
    function UpdateStatus($moduleName)
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

            class UpdateStatus
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        if (!\$data = self::\$model::query()->where('slug', request('slug'))->first()) {
                            return messageResponse('Data not found...', \$data, 404, 'error');
                        }
                        if (\$data->status == 'active') {
                            \$data->status = 'inactive';
                        } else {
                            \$data->status = 'active';
                        }
                        \$data->update();
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
