<?php

namespace App\Utils;

class ImageCompress
{
    public static function compressImage($source, $quality, $uploadPath, $hiegth)
    {
        //Generate New File Name
        $newFrontImageName = \Illuminate\Support\Str::uuid() . '.' . $source->getClientOriginalExtension();
        //Get The Upload Folder
        $destinationPath = public_path($uploadPath);
        //Combine new File name with destination upload folder
        $newImageUploadedPath = $destinationPath .'/' . $newFrontImageName;

        //Define image compression lib
        $interventionImage = new \Intervention\Image\Facades\Image();
        //Resize Image
        $image = $interventionImage::make($source->getRealPath())->resize(null,$hiegth,function($constraint){
            $constraint->aspectRatio();
        });
        //Save Image to upload location
        $image->save($newImageUploadedPath,$quality);
        //return new Upload Image
        return $uploadPath .'/' . $newFrontImageName ;
    }
}
