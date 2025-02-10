<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->with('sections.settings')->firstOrFail();

        // all sections data will be stored in this array
        $sections = [];

        foreach ($page->sections as $section) {
            $sectionData = [];

            foreach ($section->settings as $setting) {
                $sectionData[$setting->key] = $setting->value;
            }

            $sections[$section->code] = $sectionData;
        }

        return view("frontend.modules.{$slug}.index", compact('page', 'sections'));
    }


    /**
     * Helper function to check if a string is JSON.
     */
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

