<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Active blog posts fetch (paginated)
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Active categories (for sidebar filtering, if needed)
        $categories = Category::where('status', 1)->get();

        // (Optional) You can add additional data here if needed,
        // such as tags, latest posts etc.

        // Return the Blog index view
        return view('frontend.modules.blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        // Single blog post fetch
        $post = Post::with('approvedComments')->where('slug', $slug)->firstOrFail();

        // Banner: single blog page banner image clicked post image
        $bannerImage = $post->post_image
            ? 'assets/image/postimage/original/' . $post->post_image
            : 'assets/image/postimage/original/default_banner.jpg';



        // Related posts example: 3 latest posts excluding current
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Sidebar Data:
        $latestPosts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();

        return view('frontend.modules.single-blog.index', compact(
            'post',
            'bannerImage',
            'relatedPosts',
            'latestPosts',
            'categories',
            'tags'
        ));
    }


    // blog Search
    // public function search(Request $request)
    // {
    //     $query = $request->input('search');

    //     // Posts search logic: title or description keyword match
    //     $posts = Post::where('status', 1)
    //         ->where(function ($q) use ($query) {
    //             $q->where('title', 'like', "%{$query}%")
    //                 ->orWhere('description', 'like', "%{$query}%");
    //         })
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     // Sidebar data fetch
    //     $categories = Category::where('status', 1)->get();
    //     $tags = Tag::where('status', 1)->get();
    //     $latestPosts = Post::where('status', 1)
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //     // blog page confirmation fetch
    //     $page = Page::where('slug', 'blog')->first();

    //     // Return view with search results; pass $query for display if needed
    //     return view('frontend.modules.blog.index', compact('posts', 'categories', 'tags', 'latestPosts', 'page', 'query'));
    // }

    public function search(Request $request)
{
    $query   = $request->input('search'); // Keyword search, যদি থাকে
    $tagSlug = $request->input('tag');     // Tag filter, যদি থাকে

    // Base query: শুধুমাত্র active posts
    $postsQuery = Post::where('status', 1);

    // যদি search query থাকে, তাহলে title এবং description-এর উপর ভিত্তি করে ফিল্টার করুন
    if ($query) {
        $postsQuery->where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        });
    }

    // যদি tag filter থাকে, তাহলে posts এর সাথে সম্পর্কিত ট্যাগগুলি খুঁজে বের করুন
    if ($tagSlug) {
        $postsQuery->whereHas('tags', function ($q) use ($tagSlug) {
            $q->where('slug', $tagSlug);
        });
    }

    // Order এবং paginate করুন
    $posts = $postsQuery->orderBy('created_at', 'desc')->paginate(10);

    // Sidebar-এর জন্য অতিরিক্ত ডেটা fetch
    $categories = Category::where('status', 1)->get();
    $tags       = Tag::where('status', 1)->get();
    $latestPosts = Post::where('status', 1)
                       ->orderBy('created_at', 'desc')
                       ->take(5)
                       ->get();

    // Blog page configuration fetch (যদি প্রয়োজন হয়)
    $page = Page::where('slug', 'blog')->first();

    // Return view with all variables; pass both $query and $tagSlug for display purposes
    return view('frontend.modules.blog.index', compact('posts', 'categories', 'tags', 'latestPosts', 'page', 'query', 'tagSlug'));
}


    // single search

    public function singleSearch(Request $request)
    {
        $query = $request->input('search');

        // search bassed on post title
        $post = Post::where('status', 1)
            ->where('title', 'like', "%{$query}%")
            ->first();

            $bannerImage = $post->post_image
            ? 'assets/image/postimage/original/' . $post->post_image
            : 'assets/image/postimage/original/default_banner.jpg';

        if ($post) {
            // Related posts (optional)
            $relatedPosts = Post::where('id', '!=', $post->id)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            // Sidebar Data:
            $latestPosts = Post::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            $categories = Category::where('status', 1)->get();
            $tags = Tag::where('status', 1)->get();

            // comment
            $totalComments = $post->comments()->count()
            + $post->comments()->with('replies')->get()->sum(function($comment) {
                return $comment->replies->count();
            });

            // Return the single blog page view with the found post's data.
            return view('frontend.modules.single-blog.index', compact(
                'post',
                'relatedPosts',
                'latestPosts',
                'categories','bannerImage',
                'tags', 'totalComments'
            ));
        } else {
            // post not found
            return redirect()->back()->with('error', 'No post found for the search query.');
        }
    }




}
