<?php

namespace App\Modules\UserManagement\User\Actions;

use App\Modules\UserManagement\User\Validations\Validation;
use Illuminate\Support\Facades\Storage;

class Store
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute(Validation $request)
    {
        try {
            $requestData = $request->validated();

            $imageName = 'dummy.png';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Storage::disk('public')->put("uploads/user", $image);
            }

            $requestData['image'] = $imageName;
            if (self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
