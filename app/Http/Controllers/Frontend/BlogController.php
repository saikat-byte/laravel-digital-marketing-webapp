<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Blog page fetch করুন (Page model‑এ শুধুমাত্র name, slug আছে)
        $page = Page::where('slug', 'blog')->firstOrFail();

        // Blog page‑এর সকল active sections fetch করুন
        $sections = PageSection::where('page_id', $page->id)
                    ->where('status', 1)
                    ->orderBy('order')
                    ->get();

        // Blog hero sectiion fetch from dynamic blog page data
        $heroSection = $sections->where('slug', 'blog-hero')->first();

        // Blog post data fetch করুন
        $posts = Post::where('status', 1)
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        // Active categories
        $categories = Category::where('status', 1)->get();

        return view('frontend.modules.blog-content.index', compact('page', 'sections', 'heroSection', 'posts', 'categories'));
    }



    public function show($slug)
    {
        // Single blog post fetch
        $post = Post::where('slug', $slug)->firstOrFail();
        // Related posts (উদাহরণস্বরূপ)
        $relatedPosts = Post::where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

        // Blog page configuration (যদি hero section অথবা common layout-এর জন্য দরকার হয়)
        $page = Page::where('slug', 'blog')->first();

        // View-এ pass করুন
        return view('frontend.modules.blog.show', compact('page', 'post', 'relatedPosts'));
    }
}
