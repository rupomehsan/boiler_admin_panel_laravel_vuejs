<?php

namespace App\Modules\Management\UserManagement\User\Actions;

use Illuminate\Support\Facades\Hash;

class UserChangePassword
{
    static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;

    public static function execute($request)
    {
        try {

            $user = self::$model::find(auth()->id());

            if (!$user || !Hash::check($request->current_password, $user->password)) {
                return messageResponse('Current password does not match', [], 404, 'error');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();
            return messageResponse('Password successfully changed', [], 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
