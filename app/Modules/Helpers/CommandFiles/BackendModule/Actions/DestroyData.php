<?php

use Illuminate\Support\Str;

if (!function_exists('DestroyData')) {
    function DestroyData($moduleName)
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

            class DestroyData
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute(\$slug)
                {
                    try {

                        if (!\$data = self::\$model::where('slug', \$slug)->first()) {
                            return messageResponse('Data not found...', \$data, 404, 'error');
                        }
                        \$data->forceDelete();
                        return messageResponse('Item Successfully deleted', [], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(), [], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}
