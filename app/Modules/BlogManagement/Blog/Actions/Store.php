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
 
            $requestData = $request->validated();
            $blog_category_id = json_decode($request->blog_category_id);
            $reqtags = json_decode($request->tags);
            $tags = null;

            if ($reqtags && count($reqtags)) {
                foreach ($reqtags as $item) {
                    $tags .= $item . ',';
                }
            }

            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $currentDate = now()->format('Y/m');
                $requestData['thumbnail_image'] = Storage::disk('public')->put("uploads/blog/{$currentDate}", $image);
            }



            if ($request->hasFile('images')) {
                foreach ($request->images as $key => $image) {
                    $currentDate = now()->format('Y/m');
                    $url = uploader($image, "uploads/blog/{$currentDate}");
                    $requestData['images'][] = $url;
                }
            }


            $requestData['tags'] = $tags;
            $requestData['creator'] = auth()->id();

            if ($blog = self::$model::query()->create($requestData)) {
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
