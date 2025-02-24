<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostSeoSetting;
use Illuminate\Http\Request;

class PostSeoSettingController extends Controller
{
    // SEO settings list for posts (optional)
    public function postSeoIndex()
    {
        $posts = Post::with('seoSetting')->orderBy('id', 'desc')->get();
    return view('admin.modules.seo.post_index', compact('posts'));
    }

    // Edit SEO settings for a specific post
    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $seo = PostSeoSetting::firstOrNew(['post_id' => $post->id]);
        return view('admin.modules.seo.post_edit', compact('post', 'seo'));
    }

    // Update or create SEO settings for a post
    public function update(Request $request, $postId)
{
    $post = Post::findOrFail($postId);

    $validated = $request->validate([
        'meta_title'          => 'nullable|string|max:255',
        'meta_description'    => 'nullable|string',
        'meta_keywords'       => 'nullable|string',
        'og_title'            => 'nullable|string|max:255',
        'og_description'      => 'nullable|string',
        'og_image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'twitter_card'        => 'nullable|string|max:100',
        'twitter_title'       => 'nullable|string|max:255',
        'twitter_description' => 'nullable|string',
        'twitter_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'canonical_url'       => 'nullable|url',
        'structured_data'     => 'nullable|string',
    ]);

    // Retrieve existing SEO record once
    $seoRecord = PostSeoSetting::firstOrNew(['post_id' => $post->id]);

    // Handle OG Image update
    if ($request->hasFile('og_image')) {
        if ($seoRecord->og_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($seoRecord->og_image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($seoRecord->og_image);
        }
        $ogImage = $request->file('og_image');
        $ogFilename = 'og_' . time() . '.' . $ogImage->getClientOriginalExtension();
        $ogPath = $ogImage->storeAs('seo/og_images', $ogFilename, 'public');
        $validated['og_image'] = $ogPath;
    }

    // Handle Twitter Image update
    if ($request->hasFile('twitter_image')) {
        if ($seoRecord->twitter_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($seoRecord->twitter_image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($seoRecord->twitter_image);
        }
        $twImage = $request->file('twitter_image');
        $twFilename = 'twitter_' . time() . '.' . $twImage->getClientOriginalExtension();
        $twPath = $twImage->storeAs('seo/twitter_images', $twFilename, 'public');
        $validated['twitter_image'] = $twPath;
    }

    // Update or create SEO record
    $seo = PostSeoSetting::updateOrCreate(
        ['post_id' => $post->id],
        $validated
    );

    return redirect()->back()->with('success', 'SEO settings updated successfully!');
}

}
