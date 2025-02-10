<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ImageService
{
    public function handleUpload($file, $path)
    {
        if ($file instanceof UploadedFile) {
            $filename = time() . '_' . $file->getClientOriginalName();
            return $file->storeAs($path, $filename, 'public');
        }
        return null;
    }

    public function deleteFile($path)
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }

    public function handleMultipleUploads($files, $path)
    {
        $paths = [];
        foreach ($files as $file) {
            if ($uploadedPath = $this->handleUpload($file, $path)) {
                $paths[] = $uploadedPath;
            }
        }
        return $paths;
    }
}
