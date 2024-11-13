<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\support\Str;



/*
|--------------------------------------------------------------------------
| uploader
|--------------------------------------------------------------------------
*/

if (!function_exists('uploader')) {
    function uploader($source, $path, $width = null, $height = null, $file_name = null)
    {
        // dd($source->getClientMimeType(), $source->getClientOriginalExtension(), $source->getClientOriginalName());
        $mime_type = $source->getClientMimeType();

        // dd($mime_type);
        if ($mime_type != "image/png" && $mime_type != "image/jpeg" && $mime_type != "image/jpg") {
            $path = Storage::putFile($path, $source);
            return $path;
        }


        $image = Image::make($source);

        if (!$path) {
            $path = public_path('uploads');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        } else {
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
        }
        if (!$file_name) {
            $file_name = Carbon::now()->toDateTimeString();
            $file_name = Str::slug($file_name) . rand(999, 99999);
            $file_name .= "." . $source->getClientOriginalExtension();
        } else {
            $file_name = Str::slug($file_name);
        }

        if ($width || $height) {
            $image->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $full_name = $path . '/' . $file_name;
        $image->save(public_path($full_name));
        return $full_name;
    }
}
