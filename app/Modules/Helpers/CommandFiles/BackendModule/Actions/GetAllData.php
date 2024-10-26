<?php

use Illuminate\Support\Str;

if (!function_exists('GetAllData')) {
    function GetAllData($moduleName)
    {

        $formated_module = explode('/', $moduleName);

        // dd($formated_module);

        if (count($formated_module) > 1) {
            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\{$moduleName}\\Actions;

        class GetAllData
        {
            static \$model = \App\Modules\\{$moduleName}\\Models\\Model::class;

            public static function execute(\$request)
            {
                try {
                    \$pageLimit = request()->input('limit') ?? 10;
                    \$orderByColumn = request()->input('sort_by_col') ?? 'id';
                    \$orderByType = request()->input('sort_type') ?? 'asc';
                    \$status = request()->input('status') ?? 'active';
                    \$fields = request()->input('fields') ?? '*';
                    \$with = [];
                    \$condition = [];

                    \$data = self::\$model::query();

                    if (request()->has('search') && request()->input('search')) {
                        \$searchKey = request()->input('search');
                        \$data = \$data->where(function (\$q) use (\$searchKey) {
                            \$q->where('title', \$searchKey);
                            \$q->orWhere('description', 'like', '%' . \$searchKey . '%');
                        });
                    }

                    if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->limit(\$pageLimit)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->get();
                    } else {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->paginate(\$pageLimit);
                    }
                    return entityResponse(\$data);
                } catch (\Exception \$e) {
                    return messageResponse(\$e->getMessage(),[], 500, 'server_error');
                }
            }
        }
        EOD;

        return $content;
    }
}
