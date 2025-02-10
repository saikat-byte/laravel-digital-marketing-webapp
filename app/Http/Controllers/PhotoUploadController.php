<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class PhotoUploadController extends Controller
{
    public static function imageUpload($name, $height, $width, $path, $file)
    {
        // Create ImageManager instance
        $manager = new ImageManager(new Driver());

        // Set image name and path
        $image_name = $name . '.webp';
        $destination_path = public_path($path);

        // Create directory if not exists
        if (!file_exists($destination_path)) {
            mkdir($destination_path, 0755, true);
        }

        // Process and save image
        $manager->read($file)
            ->cover($width, $height)
            ->toWebp(50)
            ->save($destination_path . $image_name);

        return $image_name;
    }

    public static function imageUnlink($path, $name)
    {
        $image_path = public_path($path) . $name;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
}
