<?php

namespace App\Modules\BlogManagement\Category;

use App\Modules\BlogManagement\Category\Actions\All;
use App\Modules\BlogManagement\Category\Actions\Delete;
use App\Modules\BlogManagement\Category\Actions\Show;
use App\Modules\BlogManagement\Category\Actions\Store;
use App\Modules\BlogManagement\Category\Actions\Update;
use App\Modules\BlogManagement\Category\Actions\Validation;
use App\Modules\BlogManagement\Category\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {
        $data = All::execute();
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($id)
    {
        $data = Show::execute($id);
        return $data;
    }

    public function update(Validation $request, $id)
    {
        $data = Update::execute($request, $id);
        return $data;
    }

    public function destroy($id)
    {
        $data = Delete::execute($id);
        return $data;
    }
    public function bulkAction()
    {
        $data = BulkActions::execute();
        return $data;
    }

}