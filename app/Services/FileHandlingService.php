<?php
namespace App\Services;

use App\Models\PageSection;
use Illuminate\Support\Facades\Storage;

class FileHandlingService
{
    protected function getBasePath(PageSection $section)
    {
        // Make path more specific with section type
        return "pages/{$section->page->slug}/sections/{$section->code}";
    }

    public function handleSingleFileUpload($file, PageSection $section)
    {
        if ($file && $file->isValid()) {
            // Generate unique filename with timestamp
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $path = $this->getBasePath($section);

            // Ensure directory exists
            Storage::disk('public')->makeDirectory($path);

            return $file->storeAs($path, $filename, 'public');
        }
        return null;
    }

    public function deleteFile($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
