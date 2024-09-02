<?php

namespace App\Modules\BlogManagement\Blog\Actions;

use App\Modules\BlogManagement\Blog\Actions\Validation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Store
{
    static $model = \App\Modules\BlogManagement\Blog\Model::class;

    public static function execute(Validation $request)
    {
        try {
            $blog_category_id = json_decode($request->blog_category_id);
            $reqtags = json_decode($request->tags);
            $tags = null;

            $imageName = 'dummy.png';
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


            if ($blog = self::$model::query()->create(array_merge(
                $request->validated(),
                [
                    "thumbnail_image" => $imageName,
                    "tags" => $tags,
                    "creator" => auth()->id(),
                ]
            ))) {
                if ($blog_category_id && count($blog_category_id)) {
                    $blog->categories()->attach($blog_category_id);
                }
                return messageResponse('Item added successfully', 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), 500, 'server_error');
        }
    }
}
