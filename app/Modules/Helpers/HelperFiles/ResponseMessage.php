<?php
/*
|--------------------------------------------------------------------------
| entityResponse
|--------------------------------------------------------------------------
*/
if (!function_exists('entityResponse')) {
    function entityResponse($data = null, $statusCode = 200, $status = 'success', $message = null)
    {
        $payload = ['status' => $status, 'statusCode' => $statusCode, 'data' => $data];

        if ($message) {
            $payload['message'] = $message;
        }

        return response($payload, $statusCode);
    }
}
/*
|--------------------------------------------------------------------------
| messageResponse
|--------------------------------------------------------------------------
*/
if (!function_exists('messageResponse')) {
    function messageResponse($message = '', $data = [], $statusCode = 200, $status = 'success')
    {
        return response(['status' => $status, 'statusCode' => $statusCode, 'message' => $message, 'data' => $data], $statusCode);
    }
}
/*
|--------------------------------------------------------------------------
| additionalValidation
|--------------------------------------------------------------------------
*/
if (!function_exists('additionalValidation')) {
    function additionalValidation($data)
    {
        $errorPayload = [];
        if ($data && count($data) > 0) {
            foreach ($data as $key => $value) {
                $errorPayload[$value] = [
                    $value . ' is required'
                ];
            }
        }
        return response()->json([
            'status' => 'validation_error',
            'errors' => $errorPayload
        ], 422);
    }
}
