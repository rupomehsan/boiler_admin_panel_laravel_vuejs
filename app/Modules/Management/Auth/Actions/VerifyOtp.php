<?php

namespace App\Modules\Management\Auth\Actions;

use Illuminate\Support\Facades\DB;

class VerifyOtp
{
    protected static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;

    public static function execute()
    {
        try {
            $requestData = request()->all();

            if (in_array("", $requestData['code'], true) || in_array(null, $requestData['code'], true)) {
                return messageResponse('Fields must not be empty', [], 400, 'error');
            }

            $OTP = implode('', array_map(fn($digit) => $digit ?? '0', array_pad($requestData['code'], 6, '0')));
            $otpRecordQuery = DB::table('otp_codes')
                ->where('email', $requestData['email'])
                ->where('otp', $OTP);

            // Check if the record exists
            if (!$otpRecordQuery->exists()) {
                return messageResponse('Invalid OTP', [], 400, 'error');
            }

            // Delete the record directly
            $otpRecordQuery->delete();

            return messageResponse('Your OTP successfully matched', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
