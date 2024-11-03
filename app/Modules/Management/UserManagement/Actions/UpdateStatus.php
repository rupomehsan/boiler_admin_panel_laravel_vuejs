<?php

namespace App\Modules\Management\UserManagement\Actions;

class UpdateStatus
{
    static $model = \App\Modules\Management\UserManagement\Models\Model::class;

    public static function execute()
    {
        try {
            if (!$data = self::$model::where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            if (request()->status == 'active') {
                $data->status = 'inactive';
            } elseif (request()->status == 'inactive') {
                $data->status = 'active';
            }

            $data->update();
            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
