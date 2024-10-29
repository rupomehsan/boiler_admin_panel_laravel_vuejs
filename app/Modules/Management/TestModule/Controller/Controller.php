<?php

namespace App\Modules\TestModule;

use App\Modules\TestModule\Actions\All;
use App\Modules\TestModule\Actions\Destroy;
use App\Modules\TestModule\Actions\Show;
use App\Modules\TestModule\Actions\Store;
use App\Modules\TestModule\Actions\Update;
use App\Modules\TestModule\Actions\SoftDelete;
use App\Modules\TestModule\Actions\Restore;
use App\Modules\TestModule\Actions\Import;
use App\Modules\TestModule\Validations\BulkActionsValidation;
use App\Modules\TestModule\Validations\GetAllValidation;
use App\Modules\TestModule\Validations\Validation;
use App\Modules\TestModule\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index(GetAllValidation $request)
    {
        $data = All::execute($request);
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = Show::execute($slug);
        return $data;
    }

    public function update(Validation $request, $slug)
    {
        $data = Update::execute($request, $slug);
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = Destroy::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = Restore::execute();
        return $data;
    }
    public function import()
    {
        $data = Import::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

}