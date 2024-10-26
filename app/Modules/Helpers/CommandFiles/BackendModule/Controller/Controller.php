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

        namespace App\\Modules\\{$moduleName};

        use App\\Modules\\{$moduleName}\\Actions\All;
        use App\\Modules\\{$moduleName}\\Actions\Destroy;
        use App\\Modules\\{$moduleName}\\Actions\Show;
        use App\\Modules\\{$moduleName}\\Actions\Store;
        use App\\Modules\\{$moduleName}\\Actions\Update;
        use App\\Modules\\{$moduleName}\\Actions\SoftDelete;
        use App\\Modules\\{$moduleName}\\Actions\Restore;
        use App\\Modules\\{$moduleName}\\Actions\Import;
        use App\\Modules\\{$moduleName}\\Validations\\BulkActionsValidation;
        use App\\Modules\\{$moduleName}\\Validations\\GetAllValidation;
        use App\\Modules\\{$moduleName}\\Validations\\Validation;
        use App\\Modules\\{$moduleName}\\Actions\BulkActions;
        use App\Http\Controllers\Controller as ControllersController;


        class Controller extends ControllersController
        {

            public function index(GetAllValidation \$request)
            {
                \$data = All::execute(\$request);
                return \$data;
            }

            public function store(Validation \$request)
            {
                \$data = Store::execute(\$request);
                return \$data;
            }

            public function show(\$slug)
            {
                \$data = Show::execute(\$slug);
                return \$data;
            }

            public function update(Validation \$request, \$slug)
            {
                \$data = Update::execute(\$request, \$slug);
                return \$data;
            }

            public function softDelete()
            {
                \$data = SoftDelete::execute();
                return \$data;
            }
            public function destroy(\$slug)
            {
                \$data = Destroy::execute(\$slug);
                return \$data;
            }
            public function restore()
            {
                \$data = Restore::execute();
                return \$data;
            }
            public function import()
            {
                \$data = Import::execute();
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
