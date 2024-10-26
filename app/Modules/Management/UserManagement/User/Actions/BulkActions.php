<?php

namespace App\Modules\UserManagement\User\Actions;

class BulkActions
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute()
    {
        try {
            if (request()->input('action') == 'active' || request()->input('action') == 'inactive') {
                if (request()->input('data') && count(request()->input('data'))) {

                    $data = request()->input('data');
                    foreach ($data as $item) {
                        $getItem = self::$model::find($item);

                        if ($getItem) {
                            $getItem->status = request()->input('action');
                            $getItem->update();
                        }
                    }
                }
            }

            if (request()->input('action') == 'delete') {
                if (request()->input('data') && count(request()->input('data'))) {
                    $data = request()->input('data');
                    foreach ($data as $item) {
                        $getItem = self::$model::find($item);
                        if ($getItem) {
                            $getItem->delete();
                        }
                    }
                }
            }

            return messageResponse("Items are Successfully " . request()->input('action'), 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
