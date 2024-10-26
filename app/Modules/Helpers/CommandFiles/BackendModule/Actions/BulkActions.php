<?php

use Illuminate\Support\Str;

if (!function_exists('BulkActions')) {
    function BulkActions($moduleName)
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

        namespace App\\Modules\\{$moduleName}\\Actions;

        class BulkActions
        {
            static \$model = \App\Modules\\{$moduleName}\\Models\\Model::class;

            public static function execute()
            {
                try {
                    if (request()->input('action') == 'active') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->update(['status' => 'active']);
                        }
                        return messageResponse("Items are activeted Successfully ");
                    }
                    if (request()->input('action') == 'inactive') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->update(['status' => 'inactive']);
                            return messageResponse("Items are inactiveted Successfully ");
                        }
                    }

                    if (request()->input('action') == 'delete') {
                        if (request()->input('ids') && count(request()->input('ids'))) {
                            \$ids = request()->input('ids');
                            self::\$model::whereIn('id', \$ids)->delete();
                            return messageResponse("Items are deleted Successfully ");
                        }
                    }


                } catch (\Exception \$e) {
                    return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                }
            }
        }

        EOD;

        return $content;
    }
}
