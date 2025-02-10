<?php

namespace App\Http\Controllers\Frontent;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //Home page
    public function index()
    {

        try {
            // First check if data exists
            $page = Page::with(['sections.settings', 'seo'])
                ->where('name', 'Home')
                ->first();

            if (!$page) {
                \Log::error('Home page not found in database');
                abort(404);
            }

            // Add this for debugging
            // dd($page->toArray());

            return view('frontend.modules.index', compact('page'));
            // all sections data will be stored in this array
        } catch (\Exception $e) {
            \Log::error('Home Page Error: ' . $e->getMessage());
            abort(404);
        }
    }
    public function service()
    {
        return view("frontend.modules.service.index");
    }
    public function caseStudies()
    {
        return view('frontend.modules.case-studies');
    }
    public function about()
    {
        return view('frontend.modules.about');
    }
    public function contact()
    {
        return view('frontend.modules.contact');
    }
    public function blog(Request $request)
    {
        $query = Post::where('status', 1);

        // Category filter
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // subCategory filter
        if ($request->has('subcategory')) {
            $query->where('sub_category_id', $request->subcategory);
        }

        // Tag Filter
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('id', $request->tag);
            });
        }

        $posts = $query->paginate(10);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $tags = Tag::all();
        return view('frontend.modules.blog', compact('posts', 'categories', 'subcategories', 'tags'));
    }
    public function singleBlog($id)
    {
        // Fetch all active categories with their subcategories
        $categories = Category::with('subcategories')->where('status', 1)->get();

        // Fetch the post with its tags and category, including the subcategory
        $post = Post::with('tag', 'category', 'subcategory')->findOrFail($id);

        // Fetch the latest 3 active posts
        $posts = Post::where('status', 1)->latest()->limit(3)->get();

        // Fetch active tags
        $tags = Tag::all();

        // Pass the data to the view
        return view('frontend.modules.single-blog', compact('post', 'categories', 'posts', 'tags'));
    }


}
