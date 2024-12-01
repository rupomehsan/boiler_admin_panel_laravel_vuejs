<?php

use Illuminate\Support\Str;

if (!function_exists('Controller')) {
    function Controller($moduleName)
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

        namespace App\\Modules\\Management\\{$moduleName}\\Controller;
        use App\\Modules\\Management\\{$moduleName}\\Actions\GetAllData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\DestroyData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\GetSingleData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\StoreData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\UpdateData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\UpdateStatus;
        use App\\Modules\\Management\\{$moduleName}\\Actions\SoftDelete;
        use App\\Modules\\Management\\{$moduleName}\\Actions\RestoreData;
        use App\\Modules\\Management\\{$moduleName}\\Actions\ImportData;
        use App\\Modules\\Management\\{$moduleName}\\Validations\\BulkActionsValidation;
        use App\\Modules\\Management\\{$moduleName}\\Validations\\DataStoreValidation;
        use App\\Modules\\Management\\{$moduleName}\\Actions\BulkActions;
        use App\Http\Controllers\Controller as ControllersController;


        class Controller extends ControllersController
        {

            public function index( ){

                \$data = GetAllData::execute();
                return \$data;
            }

            public function store(DataStoreValidation \$request)
            {
                \$data = StoreData::execute(\$request);
                return \$data;
            }

            public function show(\$slug)
            {
                \$data = GetSingleData::execute(\$slug);
                return \$data;
            }

            public function update(DataStoreValidation \$request, \$slug)
            {
                \$data = UpdateData::execute(\$request, \$slug);
                return \$data;
            }
                 public function updateStatus()
            {
                \$data = UpdateStatus::execute();
                return \$data;
            }

            public function softDelete()
            {
                \$data = SoftDelete::execute();
                return \$data;
            }
            public function destroy(\$slug)
            {
                \$data = DestroyData::execute(\$slug);
                return \$data;
            }
            public function restore()
            {
                \$data = RestoreData::execute();
                return \$data;
            }
            public function import()
            {
                \$data = ImportData::execute();
                return \$data;
            }
            public function bulkAction(BulkActionsValidation \$request)
            {
                \$data = BulkActions::execute(\$request);
                return \$data;
            }

        }
        EOD;
        return $content;
    }
}
