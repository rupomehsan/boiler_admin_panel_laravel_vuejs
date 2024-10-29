<?php

namespace App\Modules\TestModule\Actions;

class BulkActions
{
    static $model = \App\Modules\TestModule\Models\Model::class;

    public static function execute()
    {
        try {
            if (request()->input('action') == 'active') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->update(['status' => 'active']);
                }
                return messageResponse("Items are activeted Successfully ");
            }
            if (request()->input('action') == 'inactive') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->update(['status' => 'inactive']);
                    return messageResponse("Items are inactiveted Successfully ");
                }
            }

            if (request()->input('action') == 'delete') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->delete();
                    return messageResponse("Items are deleted Successfully ");
                }
            }


        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
