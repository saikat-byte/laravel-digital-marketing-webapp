<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->orderBy('id', 'desc')->get();

        return view('admin.modules.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id');

        return view('admin.modules.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'category_id' => 'required',
            'status' => 'required|boolean',
        ]);

        // Save the data to the database
        SubCategory::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category_id'],
            'status' => $validatedData['status'],
        ]);

        // Redirect with success message
        return redirect()->route('sub-category.index')->with('success', 'Sub category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $sub_category)
    {
        $sub_category->load('category');
        return view('admin.modules.sub_category.show', compact('sub_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::pluck('title', 'id'); // Parent categories
        return view('admin.modules.sub_category.edit', compact('categories', 'sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $subCategory->id,
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'status' => 'required|boolean',
        ]);

        // Update the SubCategory in the database
        $subCategory->update([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category_id'],
            'status' => $validatedData['status'],
        ]);

        // Redirect with success message
        return redirect()->route('sub-category.index')->with('success', 'Sub category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();

            return response()->json([
                'message' => 'Sub category deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the subcategory.',
            ], 500);
        }
    }

        /**
     * Get sub category.
     */
    public function getSubcategories($id)
    {
        $subCategories = SubCategory::select('id', 'title')->where('status', 1)->where('category_id', $id)->get();
        return response()->json($subCategories);
    }


}
