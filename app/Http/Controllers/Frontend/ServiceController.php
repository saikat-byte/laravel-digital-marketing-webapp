<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    final public function index($slug)
    {

        $page = Page::where('slug', $slug)->with('sections.settings')->firstOrFail();

        $sections = $page->sections->sortBy('order');

        return view("frontend.modules.{$slug}.index", compact('page', 'sections'));
    }
}
