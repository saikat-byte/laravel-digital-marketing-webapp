<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommonSectionController extends Controller
{

    // Common section list
    public function index()
    {
        $commonSections = CommonSection::orderBy('order')->get();
        $trashedSections = CommonSection::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.modules.common_sections.index', compact('commonSections', 'trashedSections'));
    }

    // common section create
    public function create()
    {
        $sectionTypes = DB::table('section_types')->get();
        $customFieldType = DB::table('custom_field_types')->get();
        return view('admin.modules.common_sections.create', compact('sectionTypes', 'customFieldType'));
    }

    // Store new common section
    public function store(Request $request)
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

        $section = new CommonSection();
        $section->name = $request->name;
        // Auto-generate slug from section name (unique slug logic can be added as needed)
        $section->slug = Str::slug($request->name);
        $section->code = $section->slug . '-' . uniqid();

        $section->type = $request->type;
        $section->description = $request->input('description');
        $section->heading = $request->input('heading');
        $section->sub_heading = $request->input('sub_heading');
        $section->paragraph = $request->input('paragraph');
        $section->button_1_text = $request->input('button_1_text');
        $section->button_1_link = $request->input('button_1_link');
        $section->button_2_text = $request->input('button_2_text');
        $section->button_2_link = $request->input('button_2_link');
        $section->order = $request->input('order', 0);
        $section->status = $request->input('status', 1);

        // Base folder using the slug
        $baseFolder = "common/{$section->slug}";

        // Image Upload
        if ($request->hasFile('image')) {
            $imageFolder = $baseFolder . "/images";
            $section->image = $request->file('image')->store($imageFolder, 'public');
        }

        // Multi-Image Upload
        $multiImages = [];
        if ($request->hasFile('multi_image')) {
            $multiImageFolder = $baseFolder . "/multi_images";
            foreach ($request->file('multi_image') as $file) {
                $multiImages[] = $file->store($multiImageFolder, 'public');
            }
        }
        $section->multi_image = $multiImages;

        // Video Upload
        if ($request->hasFile('video')) {
            $videoFolder = $baseFolder . "/videos";
            $section->video = $request->file('video')->store($videoFolder, 'public');
        }

        // PDF Upload
        if ($request->hasFile('pdf')) {
            $pdfFolder = $baseFolder . "/files";
            $section->pdf = $request->file('pdf')->store($pdfFolder, 'public');
        }

        // Custom Fields (store as key-value pairs)
        $configData = [];
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $field) {
                if (!empty($field['name']) && !empty($field['value'])) {
                    $configData[$field['name']] = $field['value'];
                }
            }
        }
        $section->config = $configData;

        $section->save();

        return response()->json([
            'success' => true,
            'message' => 'Section created successfully!',
            'data' => $section
        ]);
    }

    // Show edit form for a common section
    public function edit($id)
    {
        $section = CommonSection::findOrFail($id);
        $sectionTypes = DB::table('section_types')->get();
        $customFieldType = DB::table('custom_field_types')->get();
        return view('admin.modules.common_sections.edit', compact('section', 'sectionTypes', 'customFieldType'));
    }

    // Update a common section
    public function update(Request $request, $id)
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

        $section = CommonSection::findOrFail($id);
        $section->name = $request->name;
        // Slug remains unchanged to maintain folder structure
        $section->type = $request->type;
        $section->heading = $request->heading;
        $section->sub_heading = $request->sub_heading;
        $section->paragraph = $request->paragraph;
        $section->button_1_text = $request->button_1_text;
        $section->button_1_link = $request->button_1_link;
        $section->button_2_text = $request->button_2_text;
        $section->button_2_link = $request->button_2_link;

        // Use existing slug for folder structure
        $sectionSlug = "common/{$section->slug}";

        //Single Image Update
        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $folder = "/{$sectionSlug}/images";
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
            $folder = "common/{$sectionSlug}/multi_images";
            foreach ($request->file('multi_image') as $file) {
                $existingMultiImages[] = $file->store($folder, 'public');
            }
        }
        $section->multi_image = $existingMultiImages;

        // Video Upload
        if ($request->hasFile('video')) {
            $videoFolder = $baseFolder . "/videos";
            $section->video = $request->file('video')->store($videoFolder, 'public');
        }

        // PDF Upload
        if ($request->hasFile('pdf')) {
            $pdfFolder = $baseFolder . "/files";
            $section->pdf = $request->file('pdf')->store($pdfFolder, 'public');
        }

        // Custom Fields Update
        $configData = [];
        if ($request->has('custom_fields')) {
            foreach ($request->custom_fields as $field) {
                if (!empty($field['name']) && !empty($field['value'])) {
                    $configData[$field['name']] = $field['value'];
                }
            }
        }
        $section->config = $configData;

        $section->save();

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully!',
            'data' => $section
        ]);
    }

    // Soft delete, restore and force delete methods go here...
    public function softDelete($id)
    {
        $section = CommonSection::findOrFail($id);
        $section->delete();
        return redirect()->back()->with('success', 'Section soft-deleted successfully!');
    }

    public function restore($id)
    {
        $section = CommonSection::onlyTrashed()->findOrFail($id);
        $section->restore();
        return redirect()->back()->with('success', 'Section restored successfully!');
    }

    public function forceDelete($id)
    {
        $section = CommonSection::onlyTrashed()->findOrFail($id);
        $section->forceDelete();
        return redirect()->back()->with('success', 'Section permanently deleted!');
    }

}
