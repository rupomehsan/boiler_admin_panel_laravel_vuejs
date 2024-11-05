<?php

use Illuminate\Support\Str;

if (!function_exists('SoftDelete')) {
    function SoftDelete($moduleName)
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

            class SoftDelete
            {
                static \$model = \App\\Modules\\Management\\{$moduleName}\\Models\\Model::class;

                public static function execute()
                {
                    try {
                        if (!\$data = self::\$model::where('slug', request()->slug)->first()) {
                            return messageResponse('Data not found...', \$data, 404, 'error');
                        }

                        \$data->delete();
                        return messageResponse('Item Successfully soft deleted', [], 200, 'success');
                    } catch (\Exception \$e) {
                        return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                    }
                }
            }
            EOD;
        return $content;
    }
}
