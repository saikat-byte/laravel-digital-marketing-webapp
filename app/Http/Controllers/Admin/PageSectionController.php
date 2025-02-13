<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Facades\Validator;
use App\Services\SectionService;
use App\Http\Requests\SectionRequest;
use App\Models\PageSectionSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PageSectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }


    // slug generate with page name

    protected function uniquePageSectionSlug($pageSlug, $sectionSlug, $id = 0)
    {
        $slug = $pageSlug . '-' . $sectionSlug;
        $original = $slug;
        $count = 1;
        while (
            PageSection::where('page_id', request()->route('page')->id ?? 0)
                ->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {
            $slug = $original . '-' . $count;
            $count++;
        }
        return $slug;
    }

    // Sectiion input form submit
    public function store(Request $request, Page $page)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'heading' => 'nullable|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'button_1_text' => 'nullable|string|max:255',
            'button_1_link' => 'nullable|url',
            'button_2_text' => 'nullable|string|max:255',
            'button_2_link' => 'nullable|url',
            'custom_fields' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multi_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'video' => 'nullable|mimes:mp4,mov,avi|max:15000',
            'pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $section = new PageSection();
        $section->page_id = $page->id;
        $section->name = $request->name;

        // Generate slugs from page name and section name.
        $pageSlug = Str::slug($page->name);
        $sectionSlug = Str::slug($request->name);
        $section->slug = $this->uniquePageSectionSlug($pageSlug, $sectionSlug);
        $section->code = $section->slug . '-' . uniqid();

        $section->type = $request->type;
        $section->heading = $request->heading;
        $section->sub_heading = $request->sub_heading;
        $section->paragraph = $request->paragraph;
        $section->button_1_text = $request->button_1_text;
        $section->button_1_link = $request->button_1_link;
        $section->button_2_text = $request->button_2_text;
        $section->button_2_link = $request->button_2_link;

        // Dynamic folder creation based on page and section names
        $pageSlug = Str::slug($page->name);
        $sectionSlug = $section->slug; // already generated

        //Image Upload
        if ($request->hasFile('image')) {
            $folder = "pages/{$pageSlug}/{$sectionSlug}/images";
            $section->image = $request->file('image')->store($folder, 'public');
        }

        //Multi-Image Upload
        $multiImages = [];
        if ($request->hasFile('multi_image')) {
            $folder = "pages/{$pageSlug}/{$sectionSlug}/multi_images";
            foreach ($request->file('multi_image') as $file) {
                $multiImages[] = $file->store($folder, 'public');
            }
        }
        // $section->multi_image = json_encode($multiImages);
        $section->multi_image = $multiImages;



        //Video Upload
        if ($request->hasFile('video')) {
            $folder = "pages/{$pageSlug}/{$sectionSlug}/videos";
            $section->video = $request->file('video')->store($folder, 'public');
        }

        //PDF (or other files) Upload – Stored in a 'files' folder
        if ($request->hasFile('pdf')) {
            $folder = "pages/{$pageSlug}/{$sectionSlug}/files";
            $section->pdf = $request->file('pdf')->store($folder, 'public');
        }

        // 5. Custom Fields JSON Store
        $configData = [];
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $field) {
                if (!empty($field['name']) && !empty($field['value'])) {
                    $configData[$field['name']] = $field['value'];
                }
            }
        }
        // $section->config = json_encode($configData);
        $section->config = $configData;
        $section->save();

        return response()->json([
            'success' => true,
            'message' => 'Section created successfully!',
            'data' => $section
        ]);
    }


    // edit section
    public function edit(PageSection $section)
    {
        // ✅ Fetch Config Data (Custom Fields)
        // $config = $section->config ? json_decode($section->config, true) : ['fields' => []];
        $config = $section->config ?: ['fields' => []];

        // ✅ Fetch All Sections of the Same Page
        $sections = PageSection::where('page_id', $section->page_id)->orderBy('order')->get();

        // ✅ Fetch Section Types (From Database Table)
        $sectionTypes = DB::table('section_types')->get();

        // ✅ Fetch custom field Types (From Database Table)
        $customFieldType = DB::table('custom_field_types')->get();

        return view('admin.modules.pages.sections.edit', compact('section', 'config', 'sectionTypes', 'sections', 'customFieldType'));
    }

    /*=============== update section ===============*/

    public function update(Request $request, PageSection $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'heading' => 'nullable|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'button_1_text' => 'nullable|string|max:255',
            'button_1_link' => 'nullable|url',
            'button_2_text' => 'nullable|string|max:255',
            'button_2_link' => 'nullable|url',
            'custom_fields' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multi_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'removed_multi_images' => 'nullable|array',
        ]);

        // Update basic text fields
        $section->name = $request->name;
        $section->type = $request->type;
        $section->heading = $request->heading;
        $section->sub_heading = $request->sub_heading;
        $section->paragraph = $request->paragraph;
        $section->button_1_text = $request->button_1_text;
        $section->button_1_link = $request->button_1_link;
        $section->button_2_text = $request->button_2_text;
        $section->button_2_link = $request->button_2_link;


        $pageSlug = Str::slug($section->page->name);
        $sectionSlug = $section->slug; // Use the previously stored slug

        //Single Image Update
        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $folder = "pages/{$pageSlug}/{$sectionSlug}/images";
            $section->image = $request->file('image')->store($folder, 'public');
        }
        if ($request->input('remove_image') == '1') {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $section->image = null;
        }

        //Multi-Image Update
        $existingMultiImages = $section->multi_image ?? [];

        // Process removal of existing multi images
        if ($request->has('removed_multi_images')) {
            $removedImages = $request->input('removed_multi_images'); // Array of image paths
            foreach ($removedImages as $imgPath) {
                if (($key = array_search($imgPath, $existingMultiImages)) !== false) {
                    if (Storage::disk('public')->exists($imgPath)) {
                        Storage::disk('public')->delete($imgPath);
                    }
                    unset($existingMultiImages[$key]);
                }
            }
            $existingMultiImages = array_values($existingMultiImages);
        }

        // Add new multi images if uploaded
        if ($request->hasFile('multi_image')) {
            $folder = "pages/{$pageSlug}/{$sectionSlug}/multi_images";
            foreach ($request->file('multi_image') as $file) {
                $existingMultiImages[] = $file->store($folder, 'public');
            }
        }
        $section->multi_image = $existingMultiImages;

        // Video Update
        if ($request->hasFile('video')) {
            if ($section->video && Storage::disk('public')->exists($section->video)) {
                Storage::disk('public')->delete($section->video);
            }
            $folder = "pages/{$pageSlug}/{$sectionSlug}/videos";
            $section->video = $request->file('video')->store($folder, 'public');
        }
        if ($request->input('remove_video') == '1') {
            if ($section->video && Storage::disk('public')->exists($section->video)) {
                Storage::disk('public')->delete($section->video);
            }
            $section->video = null;
        }

        // Pdf/excel/others file Update
        if ($request->hasFile('pdf')) {
            if ($section->pdf && Storage::disk('public')->exists($section->pdf)) {
                Storage::disk('public')->delete($section->pdf);
            }
            $folder = "pages/{$pageSlug}/{$sectionSlug}/files";
            $section->pdf = $request->file('pdf')->store($folder, 'public');
        }
        if ($request->input('remove_pdf') == '1') {
            if ($section->pdf && Storage::disk('public')->exists($section->pdf)) {
                Storage::disk('public')->delete($section->pdf);
            }
            $section->pdf = null;
        }

        // 5. Custom Fields Update
        $configData = [];
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $field) {
                if (!empty($field['name']) && !empty($field['value'])) {
                    $configData[$field['name']] = $field['value'];
                }
            }
        }
        // $section->config = json_encode($configData);
        $section->config = $configData;
        $section->save();

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully!',
            'data' => $section
        ]);
    }

    // store content for the section
    public function storeContent(Request $request, PageSection $section)
    {
        try {
            DB::beginTransaction();

            foreach ($request->settings as $key => $value) {
                $group = null; // Default group NULL থাকবে

                if (strpos($key, 'image_') !== false) {
                    $group = 'images';
                } elseif (strpos($key, 'button_') !== false) {
                    $group = 'buttons';
                }

                if ($request->hasFile("settings.$key")) {
                    // image or file upload
                    $path = $request->file("settings.$key")->store('page_sections', 'public');
                    $value = $path;
                }

                // Data Store in DB based on key
                $section->settings()->updateOrCreate(
                    ['key' => $key, 'group' => $group],
                    ['value' => $value, 'value_type' => is_string($value) ? 'text' : 'image']
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Section content stored successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error storing section content: ' . $e->getMessage());
        }
    }

    // update section content
    public function updateOrder(Request $request)
    {
        $order = $request->input('order') ?? [];
        \Log::info('Order received in updateOrder:', $order);
        foreach ($order as $index => $pageSectionId) {
          PageSection::where('id', $pageSectionId)->update(['order' => $index]);
        }
        return response()->json(['success' => true, 'message' => 'Order updated successfully!']);
    }


    // delete image
    public function deleteImage(Request $request, PageSection $section)
    {
        try {
            // Validate the request
            $request->validate([
                'image_path' => 'required|string'
            ]);

            $imagePath = $request->image_path;

            // Find the setting entry in DB
            $setting = $section->settings()->where('key', 'logos')->first();

            if (!$setting) {
                return response()->json(['success' => false, 'message' => 'No image settings found!']);
            }

            $images = json_decode($setting->value, true) ?? [];

            // If image exists in DB, remove it from the array
            if (in_array($imagePath, $images)) {
                $images = array_filter($images, fn($img) => $img !== $imagePath);

                // Delete the image from storage
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Update database entry
                $setting->update([
                    'value' => json_encode(array_values($images))
                ]);

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'Image not found in database!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    // soft delete
    public function softDelete($id)
    {
        try {
            $section = PageSection::findOrFail($id);
            $section->delete(); // Soft delete

            return redirect()->back()->with('success', 'Section moved to trash successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error moving section to trash: ' . $e->getMessage());
        }
    }

    // restore
    public function restore($id)
    {
        try {
            $section = PageSection::onlyTrashed()->findOrFail($id);
            $section->restore();

            return redirect()->back()->with('success', 'Section restored successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error restoring section: ' . $e->getMessage());
        }
    }

    // force delete
    public function forceDelete($id)
    {
        try {
            $section = PageSection::withTrashed()->findOrFail($id);
            $section->forceDelete(); // Permanent Delete

            return redirect()->back()->with('success', 'Section permanently deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error permanently deleting section: ' . $e->getMessage());
        }
    }

    // toggle visibility
    public function toggleVisibility(PageSection $section)
    {
        $section->update(['status' => !$section->status]);

        return response()->json([
            'success' => true,
            'message' => 'Section visibility updated successfully!',
            'data' => $section
        ]);
    }

    // Page section active inactive toggle
    public function toggleStatus(PageSection $section)
    {
        // Toggle the status (if status is boolean: 1 becomes 0 and vice versa)
        $section->status = !$section->status;
        $section->save();

        return response()->json([
            'success' => true,
            'status' => $section->status,
            'message' => 'Section status updated successfully!'
        ]);
    }


}




