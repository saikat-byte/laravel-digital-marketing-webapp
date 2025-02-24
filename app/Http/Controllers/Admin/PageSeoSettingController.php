<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSeoSetting;
use App\Models\Page;
use Illuminate\Http\Request;

class PageSeoSettingController extends Controller
{

    public function index()
    {
        $pages = Page::orderBy('name')->get();

        return view('admin.modules.seo.index', compact('pages'));
    }

    // SEO settings edit form for a specific page
    public function edit($pageId)
    {
        // find the page
        $page = Page::findOrFail($pageId);
        // SEO setting for the page if exists, otherwise create a new one
        $seo = PageSeoSetting::firstOrNew(['page_id' => $page->id]);
        return view('admin.modules.seo.edit', compact('page', 'seo'));
    }

    // Update or store SEO settings
    public function update(Request $request, $pageId)
    {
        $page = Page::findOrFail($pageId);

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

        // Retrieve the existing SEO record if it exists
        $seoRecord = PageSeoSetting::where('page_id', $page->id)->first();

        // File upload handling for OG Image
        if ($request->hasFile('og_image')) {
            // Delete old OG image if exists
            if ($seoRecord && $seoRecord->og_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($seoRecord->og_image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($seoRecord->og_image);
            }
            $ogImage = $request->file('og_image');
            $ogFilename = 'og_' . time() . '.' . $ogImage->getClientOriginalExtension();
            $ogPath = $ogImage->storeAs('seo/og_images', $ogFilename, 'public');
            $validated['og_image'] = $ogPath;
        }

        // File upload handling for Twitter Image
        if ($request->hasFile('twitter_image')) {
            // Delete old Twitter image if exists
            if ($seoRecord && $seoRecord->twitter_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($seoRecord->twitter_image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($seoRecord->twitter_image);
            }
            $twImage = $request->file('twitter_image');
            $twFilename = 'twitter_' . time() . '.' . $twImage->getClientOriginalExtension();
            $twPath = $twImage->storeAs('seo/twitter_images', $twFilename, 'public');
            $validated['twitter_image'] = $twPath;
        }

        // Update or create the SEO record for this page
        $seo = PageSeoSetting::updateOrCreate(
            ['page_id' => $page->id],
            $validated
        );

        return redirect()->back()->with('success', 'SEO settings updated successfully!');
    }


}
