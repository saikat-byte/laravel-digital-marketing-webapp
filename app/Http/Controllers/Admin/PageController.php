<?php
// app/Http/Controllers/Admin/PageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;
class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        $pages = Page::withCount('sections')->withTrashed()->get();

        $totalPages = Page::count();
        $activePages = Page::where('status', 1)->count();
        $totalSections = PageSection::count();
        $activeSections = PageSection::where('status', 1)->count();

        return view('admin.modules.pages.index', compact('pages', 'totalPages', 'activePages', 'totalSections', 'activeSections'));
    }


    public function create()
    {

        return view('admin.modules.pages.create');
    }

    public function store(PageRequest $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pages,name',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'order' => 'required|integer'
        ]);

        $page = Page::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'order' => $request->order
        ]);

        return redirect()->route('page.index')->with('success', 'Page created successfully!');
    }

    public function edit(Page $page)
    {
        $activeSections = $page->sections()->whereNull('deleted_at')->get();
        $trashedSections = $page->sections()->onlyTrashed()->get();

        $sectionTypes = DB::table('section_types')->get();
        $customFieldType = DB::table('custom_field_types')->get();

        return view('admin.modules.pages.edit', compact('page', 'activeSections', 'trashedSections', 'sectionTypes', 'customFieldType'));
    }


    public function update(Request $request, Page $page)
    {
        try {
            DB::beginTransaction();

            $this->pageService->updatePage($page, $request->all());

            if ($request->has('sections')) {
                foreach ($request->sections as $sectionId => $sectionData) {
                    $section = $page->sections()->findOrFail($sectionId);
                    $this->pageService->handleSectionUpdate($request, $section, $sectionData);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Page updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Page Update Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating page: ' . $e->getMessage())
                ->withInput();
        }
    }


    protected function handleSectionUpdate(Request $request, PageSection $section, array $data)
    {
        foreach ($data as $key => $value) {
            // Get the proper storage path based on section code
            $storagePath = $this->getSectionStoragePath($section->code);

            if ($request->hasFile("sections.{$section->id}.{$key}")) {
                // Multiple files
                if (is_array($request->file("sections.{$section->id}.{$key}"))) {
                    $files = $request->file("sections.{$section->id}.{$key}");
                    $paths = [];

                    foreach ($files as $file) {
                        if ($file && $file->isValid()) {
                            // Store in specific folder
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $path = $file->storeAs($storagePath, $filename, 'public');
                            $paths[] = $path;
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
                // Single file
                else {
                    $file = $request->file("sections.{$section->id}.{$key}");
                    if ($file && $file->isValid()) {
                        // Delete old file
                        $oldSetting = $section->settings()->where('key', $key)->first();
                        if ($oldSetting && $oldSetting->value_type === 'file') {
                            Storage::disk('public')->delete($oldSetting->value);
                        }

                        // Store new file
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs($storagePath, $filename, 'public');
                        $value = $path;
                        $valueType = 'file';
                    }
                }
            }
            // Other data types...
            elseif (is_array($value)) {
                $value = json_encode($value);
                $valueType = 'json';
            } else {
                $valueType = 'text';
            }

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

    // Add this helper method
    protected function getSectionStoragePath($section)
    {
        // Base path
        $basePath = 'page_images/pages/' . $section->page->slug;

        // Section type based sub-folder
        $typeFolder = match ($section->type) {
            'video' => 'videos',
            'image' => 'images',
            'multi_image' => 'images',
            'file' => 'files',
            default => 'others'
        };

        return $basePath . '/' . $typeFolder;
    }


    // Soft Delete Page
    public function destroy($id)
    {
        try {
            $page = Page::findOrFail($id);
            $page->delete(); // Soft Delete

            return redirect()->route('page.index')->with('success', 'Page deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting page: ' . $e->getMessage());
        }
    }

    // Toggle Page Status
    public function toggleStatus(Page $page)
    {
        $page->status = !$page->status;
        $page->save();

        return response()->json(['success' => true, 'status' => $page->status]);
    }


    public function trashed()
    {
        $pages = Page::onlyTrashed()->get();
        return view('admin.modules.pages.trashed', compact('pages'));
    }

    // Permanently Delete Page
    public function forceDelete($id)
    {
        $page = Page::withTrashed()->findOrFail($id);
        $page->forceDelete();

        return redirect()->route('page.index')
            ->with('success', 'Page permanently deleted!');
    }

    // Restore Deleted Page
    public function restore($id)
    {
        try {
            $page = Page::withTrashed()->findOrFail($id);
            $page->restore(); // Restore the deleted page

            return redirect()->route('page.index')->with('success', 'Page restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error restoring page: ' . $e->getMessage());
        }
    }


}
