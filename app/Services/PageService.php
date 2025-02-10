<?php
// app/Services/PageService.php
namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageService
{
    protected $fileService;

    public function __construct(FileHandlingService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function createPage(array $data)
    {
        // Create page
        $page = Page::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? true
        ]);

        // Create SEO settings
        if (isset($data['meta_title']) || isset($data['meta_description']) || isset($data['meta_keywords'])) {
            $page->seo()->create([
                'meta_title' => $data['meta_title'] ?? $data['title'],
                'meta_description' => $data['meta_description'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null
            ]);
        }

        return $page;
    }

    public function updatePage(Page $page, array $data)
    {
        // Update page basic info
        $page->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 0,

        ]);

        // SEO Settings Update
        $page->seo()->updateOrCreate(
            ['page_id' => $page->id],
            [
                'meta_title' => $data['meta_title'] ?? $page->title,
                'meta_description' => $data['meta_description'] ?? Str::limit($page->description, 160),
                'meta_keywords' => $data['meta_keywords'] ?? '',
                'og_title' => $data['og_title'] ?? '',
                'og_description' => $data['og_description'] ?? '',
                'og_image' => $data['og_image'] ?? '',
                'twitter_card' => $data['twitter_card'] ?? 'summary_large_image',
                'twitter_title' => $data['twitter_title'] ?? '',
                'twitter_description' => $data['twitter_description'] ?? '',
                'twitter_image' => $data['twitter_image'] ?? '',
                'canonical_url' => $data['canonical_url'] ?? url($page->slug),
            ]
        );

        return $page;
    }

    public function handleSectionUpdate(Request $request, PageSection $section, array $data)
    {
        foreach ($data as $key => $value) {
            // Card data handling
            if (strpos($key, 'card_') === 0) {
                $cardData = is_array($value) ? $value : [];
                $oldSetting = $section->settings()->where('key', $key)->first();
                $oldData = $oldSetting ? json_decode($oldSetting->value, true) : [];

                // Handle image if uploaded
                if ($request->hasFile("sections.{$section->id}.{$key}.image")) {
                    $file = $request->file("sections.{$section->id}.{$key}.image");
                    if ($file && $file->isValid()) {
                        // Delete old image if exists
                        if (!empty($oldData['image'])) {
                            $this->fileService->deleteFile($oldData['image']);
                        }

                        // Store new image
                        $cardData['image'] = $this->fileService->handleSingleFileUpload($file, $section);
                    }
                } else {
                    // Keep old image if no new image uploaded
                    $cardData['image'] = $oldData['image'] ?? null;
                }

                // Update other card fields
                foreach ($value as $fieldKey => $fieldValue) {
                    if ($fieldKey !== 'image') {
                        $cardData[$fieldKey] = $fieldValue;
                    }
                }

                $value = json_encode($cardData);
                $valueType = 'json';
            }
            // Multiple files upload (logos)
            elseif ($request->hasFile("sections.{$section->id}.{$key}") && is_array($request->file("sections.{$section->id}.{$key}"))) {
                $files = $request->file("sections.{$section->id}.{$key}");
                $paths = [];

                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $paths[] = $this->fileService->handleSingleFileUpload($file, $section);
                    }
                }

                // Merge with existing files
                $oldSetting = $section->settings()->where('key', $key)->first();
                if ($oldSetting && $oldSetting->value_type === 'json') {
                    $existingPaths = json_decode($oldSetting->value, true) ?? [];
                    $paths = array_merge($existingPaths, $paths);
                }

                $value = json_encode(array_values(array_filter($paths)));
                $valueType = 'json';
            }
            // Single file upload
            elseif ($request->hasFile("sections.{$section->id}.{$key}")) {
                $file = $request->file("sections.{$section->id}.{$key}");
                if ($file && $file->isValid()) {
                    // Delete old file first
                    $oldSetting = $section->settings()->where('key', $key)->first();
                    if ($oldSetting && $oldSetting->value_type === 'file') {
                        $this->fileService->deleteFile($oldSetting->value);
                    }

                    $value = $this->fileService->handleSingleFileUpload($file, $section);
                    $valueType = 'file';
                }
            }
            // For other JSON data
            elseif (is_array($value)) {
                $value = json_encode($value);
                $valueType = 'json';
            }
            // Normal text value
            else {
                $valueType = 'text';
            }

            // Update or create setting only if value is set
            if (isset($value)) {
                $section->settings()->updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $value,
                        'value_type' => $valueType
                    ]
                );
            }
        }
    }
}
