<?php

namespace App\Modules\Management\TestModule\Actions;

class UpdateStatus
{
    static $model = \App\Modules\Management\TestModule\Models\Model::class;

    public static function execute()
    {
        try {
            if (!$data = self::$model::query()->where('slug', request('slug'))->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            if ($data->status == 'active') {
                $data->status = 'inactive';
            } else {
                $data->status = 'active';
            }
            $data->update();
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}