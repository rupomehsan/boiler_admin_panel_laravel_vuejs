<?php

namespace App\Modules\Management\Auth\Actions;

use App\Modules\UserManagement\User\Models\Model as UserModel;

class AuthCheck
{
    public static function execute()
    {
        try {
            if (auth()->check()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
