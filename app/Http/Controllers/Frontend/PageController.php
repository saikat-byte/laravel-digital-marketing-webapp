<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSeoSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // ✅ Fetch Page by Slug
        $page = Page::where('slug', $slug)->firstOrFail();

        // ✅ Fetch Page SEO Data
        $seo = PageSeoSetting::where('page_id', $page->id)->first();

        // ✅ Fetch Active Sections
        $sections = PageSection::where('page_id', $page->id)
            ->where('status', 1)
            ->orderBy('order')
            ->get();

        // ✅ Return View Dynamically
        return view("frontend.modules.{$slug}.index", compact('page', 'seo', 'sections','sectionImage'));
    }
}
