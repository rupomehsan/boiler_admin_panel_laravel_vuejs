<?php

namespace App\Modules\Management\SettingManagement\WebsiteSettings\Actions;

class RestoreData
{
    static $model = \App\Modules\Management\SettingManagement\WebsiteSettings\Models\Model::class;

    public static function execute()
    {
         try {
            if (!$data = self::$model::onlyTrashed()->where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $data->restore();
            return messageResponse('Item Successfully  Restored', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}