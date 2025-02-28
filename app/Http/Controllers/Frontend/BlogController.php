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

        // default seo
        $seo = new \App\Models\PostSeoSetting();

        // Active categories (for sidebar filtering, if needed)
        $categories = Category::where('status', 1)->get();

        // (Optional) You can add additional data here if needed,
        // such as tags, latest posts etc.

        // Return the Blog index view
        return view('frontend.modules.blog.index', compact('posts', 'categories', 'seo'));
    }

    // Blog show
    public function show($slug)
    {
        // Single blog post fetch
        $post = Post::with('approvedComments')->where('slug', $slug)->firstOrFail();

        // default seo
        $seo = $post->seoSetting ?? new \App\Models\PostSeoSetting();

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
            'tags',
            'seo'
        ));
    }

    // Search function for blog posts

    public function search(Request $request)
    {
        $query = $request->input('search'); // Keyword search
        $tagSlug = $request->input('tag');    // Tag filter

        $postsQuery = Post::where('status', 1);

        if ($query) {
            $postsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            });
        }

        if ($tagSlug) {
            $postsQuery->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        // Order and paginate posts
        $posts = $postsQuery->orderBy('created_at', 'desc')->paginate(10);

        // Fetch sidebar data: Categories, Tags, Latest Posts
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        $latestPosts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Blog page configuration fetch
        $page = Page::where('slug', 'blog')->first();

        // If $page null  default values assign
        if (!$page) {
            $page = new \stdClass();
            $page->name = 'Default Blog Name';
            $page->description = 'Default Blog Description';
            $page->image = ''; // image  fallback
        } else {
            // If description is null, fallback value assign
            $page->description = $page->description ?? 'Default Blog Description';
        }

        // SEO settings null check
        // If page and seo relation not found, default seo settings assign
        $seo = $page->seo ?? null;

        return view('frontend.modules.blog.index', compact(
            'posts',
            'categories',
            'tags',
            'latestPosts',
            'page',
            'query',
            'tagSlug',
            'seo'
        ));
    }

    // single search
    public function singleSearch(Request $request)
    {
        $query = $request->input('search');

        // Find post by title
        $post = Post::where('status', 1)
            ->where('title', 'like', "%{$query}%")
            ->first();

        // if post not found redirect back with error message
        if (!$post) {
            return redirect()->back()->with('error', 'No post found for the search query.');
        }

        // Banner image for single post
        $bannerImage = $post->post_image
            ? 'assets/image/postimage/original/' . $post->post_image
            : 'assets/image/postimage/original/default_banner.jpg';

        // post related data
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // sidebar data
        $latestPosts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();

        // comment count including replies
        $totalComments = $post->comments()->count() +
            $post->comments()->with('replies')->get()->sum(function ($comment) {
                return $comment->replies->count();
            });

        // single blog page data return
        return view('frontend.modules.single-blog.index', compact(
            'post',
            'relatedPosts',
            'latestPosts',
            'categories',
            'bannerImage',
            'tags',
            'totalComments'
        ));
    }


}
