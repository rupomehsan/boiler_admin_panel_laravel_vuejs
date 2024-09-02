<?php

namespace App\Modules\BlogManagement\Blog;

use App\Modules\BlogManagement\Blog\Actions\All;
use App\Modules\BlogManagement\Blog\Actions\Delete;
use App\Modules\BlogManagement\Blog\Actions\Show;
use App\Modules\BlogManagement\Blog\Actions\Store;
use App\Modules\BlogManagement\Blog\Actions\Update;
use App\Modules\BlogManagement\Blog\Actions\Validation;
use App\Modules\BlogManagement\Blog\Actions\BulkActions;
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