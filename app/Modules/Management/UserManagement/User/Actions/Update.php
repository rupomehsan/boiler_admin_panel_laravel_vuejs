<?php

namespace App\Modules\UserManagement\User\Actions;

use App\Modules\UserManagement\User\Validations\Validation;
use Illuminate\Support\Facades\Storage;

class Update
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute(Validation $request, $id)
    {
        try {
            if (!$data = self::$model::query()->where('id', $id)->first()) {
                return messageResponse('Data not found...', 404, 'error');
            }
            $requestData = $request->validated();
            $imageName = $data->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Storage::disk('public')->put("uploads/user", $image);
            }
            $requestData['image'] = $imageName;
            $data->update($requestData);
            return messageResponse('Item updated successfully');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
