<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CommonSection;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSeoSetting;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {

        // ✅ Fetch Page by Slug
        $page = Page::where('slug', $slug)->firstOrFail();

        // ✅ Fetch Page SEO Data
        $seo = PageSeoSetting::where('page_id', $page->id)->first() ?? new PageSeoSetting();

        // ✅ Fetch Active Sections
        $sections = PageSection::where('page_id', $page->id)->where('status', 1)->orderBy('order')->get();
        $sectionImage = $sections->first()->image;

        // all common section fetch
        // download section
        $downloadSection = CommonSection::where('slug', 'download-section')->where('status', 1)->first();
        // Contact form
        $contactForm = CommonSection::where('slug', 'contact-form')->where('status', 1)->first();
        // FAq section
        $faq = CommonSection::where('slug', 'faq')->where('status', 1)->first();
        // watermark section
        $watermark = CommonSection::where('slug', 'water-mark')->where('status', 1)->first();
        // contact from details section
        $contactFormRight = CommonSection::where('slug', 'contact-form-right')->where('status', 1)->first();

        // Posts
        $posts = null;
        if ($page->slug == 'case-studies') {
            $posts = Post::orderBy('created_at', 'desc')->take(6)->get();

        }
        $reviews = Review::latest()->get();

        // ✅ Return View Dynamically
        return view("frontend.modules.{$slug}.index", compact('page', 'seo', 'sections', 'sectionImage', 'downloadSection', 'contactForm', 'faq', 'watermark', 'contactFormRight', 'posts','reviews'));
    }
}
