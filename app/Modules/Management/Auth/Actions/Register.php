<?php

namespace App\Modules\Management\Auth\Actions;

use App\Modules\Auth\Validations\RegisterValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Register
{
    static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;

    public static function Register($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['password'] = Hash::make($request->password);
            unset($requestData['confirmed']);
            $user = self::$model::create($requestData);
            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            $data['user'] = $user;
            return messageResponse('Successfully Registered', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
