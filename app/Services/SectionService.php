<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Facades\Storage;

class SectionService
{
    public function createSection(Page $page, array $data)
    {
        $section = $page->sections()->create([
            'name' => $data['name'],
            'type' => $data['type'],
            'code' => $data['code'],
            'order' => $data['order'] ?? 0,
            'status' => $data['status'] ?? true,
        ]);

        if (isset($data['settings'])) {
            $this->updateSectionSettings($section, $data['settings']);
        }

        return $section;
    }

    public function updateSection(PageSection $section, array $data)
    {
        $section->update(Arr::except($data, 'settings'));

        if (isset($data['settings'])) {
            $this->updateSectionSettings($section, $data['settings']);
        }

        return $section;
    }

    protected function updateSectionSettings(PageSection $section, array $settings)
    {
        foreach ($settings as $key => $value) {
            if (request()->hasFile("settings.$key")) {
                $value = $this->handleFileUpload(request()->file("settings.$key"));
                $valueType = 'file';
            } else {
                $valueType = $this->determineValueType($value);
            }

            $section->settings()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'value_type' => $valueType
                ]
            );
        }
    }

    public function deleteSection(PageSection $section)
    {
        // Delete associated files
        foreach ($section->settings as $setting) {
            if ($setting->value_type === 'file') {
                Storage::disk('public')->delete($setting->value);
            }
        }

        return $section->delete();
    }


    public function deleteImage(PageSection $section, string $imagePath)
{
    $setting = $section->settings()->where('key', 'logos')->first();

    if ($setting) {
        $images = json_decode($setting->value, true) ?? [];
        // image delete from array
        $images = array_filter($images, fn($img) => $img !== $imagePath);

        // image delete form storage
        Storage::disk('public')->delete($imagePath);

        // store updated images array in database
        $setting->update([
            'value' => json_encode(array_values($images))
        ]);
    }
}


    protected function handleFileUpload($file)
    {
        $path = $file->store('page-sections', 'public');
        return $path;
    }

    protected function determineValueType($value)
    {
        switch (true) {
            case is_bool($value):
                return 'boolean';
            case is_numeric($value):
                return 'number';
            case is_array($value):
                return 'json';
            default:
                return 'text';
        }
    }
}
