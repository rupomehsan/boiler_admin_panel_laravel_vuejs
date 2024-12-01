<?php

namespace App\Modules\Management\SettingManagement\WebsiteSettings\Actions;

use Illuminate\Support\Facades\DB;

class StoreData
{
    static $model = \App\Modules\Management\SettingManagement\WebsiteSettings\Models\Model::class;
    static $SettingValueModel = \App\Modules\Management\SettingManagement\WebsiteSettings\Models\SettingValueModel::class;

    public static function execute()
    {
        try {
            $requestData = request()->all(); // Get all request data
            $responseData = [];

            foreach ($requestData as $title => $value) {
                if (is_null($value) && !request()->hasFile('image')) {
                    continue; // Skip if no value or image exists
                }

                DB::transaction(function () use ($title, $value, &$responseData) {
                    $finalValue = $value; // Default to the provided value

                    // Handle image upload only if the title is for an image
                    if (request()->hasFile('image') && $title === 'image') {
                        $image = request()->file('image');
                        $imagePath = uploader($image, 'uploads/settings'); // Upload the image
                        $finalValue = $imagePath; // Set the image path as the value
                    }

                    // Update or create the setting title
                    $settingTitle = self::$model::updateOrCreate(
                        ['title' => $title],
                        ['title' => $title]
                    );

                    // Update or create the setting value
                    $settingValue = self::$SettingValueModel::updateOrCreate(
                        ['setting_title_id' => $settingTitle->id],
                        ['value' => $finalValue]
                    );

                    // Collect response data for success response
                    $responseData[] = [
                        'title' => $settingTitle->title,
                        'value' => $settingValue->value,
                    ];
                });
            }

            return messageResponse('Settings updated successfully', $responseData, 200);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
