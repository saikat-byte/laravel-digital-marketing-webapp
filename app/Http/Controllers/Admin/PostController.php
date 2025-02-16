<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoUploadController;
use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // User can see only their post section
        $query = Post::with('category', 'subCategory', 'tags', 'user')->latest();
        if (Auth::user()->role === User::USER) {
            $posts = $query->where('user_id', Auth::id())->paginate(20);
        } else {
            $posts = $query->paginate(20);

        }

        return \view('admin.modules.post.index', \compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $categories = Category::where('status', 1)->pluck('title', 'id');
    //     $tags = Tag::where('status', 1)->select('id', 'title')->get();
    //     return view('admin.modules.post.create', compact('categories', 'tags'));
    // }

    public function create()
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        $subCategories = SubCategory::where('status', 1)->pluck('title', 'id'); // Fetch subcategories
        $tags = Tag::where('status', 1)->select('id', 'title')->get();

        return view('admin.modules.post.create', compact('categories', 'subCategories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        try {
            $post_data = $request->except(['post_image', 'tag_ids', 'slug']);
            $post_data['slug'] = Str::slug($request->input('slug'));
            $post_data['user_id'] = Auth::user()->id;
            $post_data['is_approved'] = 1;

            if ($request->hasFile('post_image')) {
                $file = $request->file('post_image');
                $name = Str::slug($request->input('slug'));

                // Image dimensions
                $original_width = 1000;
                $original_height = 600;
                $thumbnail_width = 300;
                $thumbnail_height = 150;

                // Paths
                $original_path = 'assets/image/postimage/original/';
                $thumbnail_path = 'assets/image/postimage/thumbnail/';

                // Upload original image
                $post_data['post_image'] = PhotoUploadController::imageUpload(
                    $name,
                    $original_height,
                    $original_width,
                    $original_path,
                    $file
                );

                // Upload thumbnail with different name
                PhotoUploadController::imageUpload(
                    $name . '_thumb', // Different name for thumbnail
                    $thumbnail_height,
                    $thumbnail_width,
                    $thumbnail_path,
                    $file
                );
            }

            // Save post data
            $post = Post::create($post_data);

            // Attach tags
            $post->tag()->attach($request->input('tag_ids')); // 'tags' corresponds to the input name in your form

            return redirect()->route('post.index')->with('success', 'Post created successfully');

        } catch (\Exception $e) {
            // Delete uploaded images if post creation fails
            if (isset($post_data['post_image'])) {
                PhotoUploadController::imageUnlink($original_path, $post_data['post_image']);
                PhotoUploadController::imageUnlink($thumbnail_path, $name . '_thumb.webp');
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating post: ' . $e->getMessage());

        }


    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title', 'id');
        $tags = Tag::where('status', 1)->select('title', 'id')->get();
        $subCategories = SubCategory::where('category_id', $post->category_id)->pluck('title', 'id');
        return \view('admin.modules.post.edit', \compact('post', 'categories', 'tags', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'quote' => 'nullable|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'status' => 'required|boolean',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag_ids' => 'nullable|array',  // Validate tag_ids as an array
        ]);

        $post = Post::findOrFail($id);

        // Check if a new image has been uploaded
        if ($request->hasFile('post_image')) {
            // Paths for original and thumbnail images
            $original_path = 'assets/image/postimage/original/';
            $thumbnail_path = 'assets/image/postimage/thumbnail/';

            // Delete old original and thumbnail images if they exist
            if ($post->post_image && file_exists(public_path($original_path . $post->post_image))) {
                unlink(public_path($original_path . $post->post_image));
            }
            if ($post->post_image && file_exists(public_path($thumbnail_path . $post->post_image))) {
                unlink(public_path($thumbnail_path . $post->post_image));
            }

            // Get the new uploaded file
            $file = $request->file('post_image');
            $name = Str::slug($request->input('slug'));  // Use slug as part of the image name

            // Image dimensions for resizing
            $original_width = 1000;
            $original_height = 600;
            $thumbnail_width = 300;
            $thumbnail_height = 150;

            // Upload original image
            $post_image = PhotoUploadController::imageUpload(
                $name, // Image name
                $original_height, // Height of the original image
                $original_width, // Width of the original image
                $original_path, // Original image folder path
                $file // The uploaded file
            );

            // Upload thumbnail image with a different name
            PhotoUploadController::imageUpload(
                $name . '_thumb', // Different name for thumbnail
                $thumbnail_height, // Height of the thumbnail
                $thumbnail_width, // Width of the thumbnail
                $thumbnail_path, // Thumbnail folder path
                $file // The uploaded file
            );

            // Assign the post image to the original image
            $post->post_image = $post_image; // Save the file name for the original image
        }

        // Update the other fields
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->quote = $request->input('quote');
        $post->description = $request->input('description');
        $post->category_id = $request->input('category_id');
        $post->sub_category_id = $request->input('sub_category_id');
        $post->status = $request->input('status');
        if ($request->has('tag_ids')) {
            $post->tag()->sync($request->input('tag_ids'));  // This ensures old tags are removed and new ones are added
        }


        // Save the updated post
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            // Image paths
            $original_path = 'assets/image/postimage/original/';
            $thumbnail_path = 'assets/image/postimage/thumbnail/';

            // Delete images if exists
            if ($post->post_image) {
                // Delete original image
                PhotoUploadController::imageUnlink($original_path, $post->post_image);

                // Delete thumbnail image
                PhotoUploadController::imageUnlink($thumbnail_path, pathinfo($post->post_image, PATHINFO_FILENAME) . '_thumb.webp');
            }

            // Delete post
            $post->delete();

            // Redirect back with success message
            return redirect()->route('post.index')->with('success', 'Post deleted successfully');

        } catch (\Exception $e) {
            // In case of any error
            return redirect()->route('post.index')->with('error', 'Error deleting post: ' . $e->getMessage());
        }
    }

}
