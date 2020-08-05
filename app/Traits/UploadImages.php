<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;


trait UploadImages
{
    public function uploadImage($request, $path = 'user_images', $width = 258, $height = 258)
    {
        Image::make($request)->resize($width, $height)->save(public_path('dashboard_files/assets/upload/' . $path . '/' . $request->hashName()));
        return $request->hashName();
    }
}
