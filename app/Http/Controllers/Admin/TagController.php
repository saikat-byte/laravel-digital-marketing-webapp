<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->get();
        return view('admin.modules.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug',
            'status' => 'required|boolean',
        ]);

        // Save the data to the database
        Tag::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'status' => $validatedData['status'],
        ]);

        // Redirect with success message
        return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.modules.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.modules.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        // Find the category by ID
        $tag = Tag::findOrFail($tag->id);

        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
            'status' => 'required|boolean',
        ]);

        // Update the category
        $tag->update([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'status' => $validatedData['status'],
        ]);

        // Redirect with success message
        return redirect()->route('tag.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            return response()->json([
                'message' => 'Tag deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the tag.',
            ], 500);
        }
    }
}
