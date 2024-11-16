<?php

namespace App\Modules\Management\SettingManagement\WebsiteSettings\Actions;

class BulkActions
{
    static $model = \App\Modules\Management\SettingManagement\WebsiteSettings\Models\Model::class;

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

            if (request()->input('action') == 'soft_delete') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->delete();
                    return messageResponse("Items are deleted Successfully ");
                }
            }

            if (request()->input('action') == 'restore') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->restore();
                    return messageResponse("Items are deleted Successfully ");
                }
            }
            if (request()->input('action') == 'destroy') {
                if (request()->input('ids') && count(request()->input('ids'))) {
                    $ids = request()->input('ids');
                    self::$model::whereIn('id', $ids)->forceDelete();
                    return messageResponse("Items are deleted Successfully ");
                }
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
