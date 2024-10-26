<?php

namespace App\Modules\BlogManagement\Blog\Actions;

use App\Modules\BlogManagement\Blog\Actions\Validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Update
{
    static $model = \App\Modules\BlogManagement\Blog\Model::class;

    public static function execute(Validation $request, $id)
    {
        try {


            if (!$data = self::$model::query()->where('id', $id)->first()) {
                return messageResponse('Data not found...', 404, 'error');
            }


            $blog_category_id = json_decode($request->blog_category_id);
            $reqtags = json_decode($request->tags);
            $tags = null;

            $imageName = $data->thumbnail_image;
            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $currentDate = now()->format('Y/m');
                $imageName = Storage::disk('public')->put("uploads/blog/{$currentDate}", $image);
            }

            if ($reqtags && count($reqtags)) {
                foreach ($reqtags as $item) {
                    $tags .= $item . ',';
                }
            }


            if ($data->update(array_merge(
                $request->validated(),
                [
                    "thumbnail_image" => $imageName,
                    "tags" => $tags,
                ]
            ))) {
                if ($blog_category_id) {
                    $data->categories()->sync($blog_category_id);
                }
                return messageResponse('Item updated successfully');
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
