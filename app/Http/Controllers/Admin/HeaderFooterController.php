<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderFooterController extends Controller
{
// Display the current header and footer settings
public function index()
{
    // Retrieve the first record (or null if none exists)
    $header = Header::first();
    $footer = Footer::first();

    return view('admin.modules.header_footer.index', compact('header', 'footer'));
}

// Update header and footer settings
public function update(Request $request)
{
    // Validate header inputs
    $headerRules = [
        'header.logo'        => 'nullable|image',
        'header.nav_links'   => 'nullable|json',
        'header.button_text' => 'nullable|string|max:255',
        'header.button_link' => 'nullable|url',
        'header.status'      => 'required|boolean',
    ];
    $validatedHeader = $request->validate($headerRules);
    $headerData = $validatedHeader['header']; // Extract nested array

    // Convert nav_links JSON to array if not empty
    if (!empty($headerData['nav_links'])) {
        $headerData['nav_links'] = json_decode($headerData['nav_links'], true);
    }

    // Validate footer inputs
    $footerRules = [
        'footer.logo'          => 'nullable|image',
        'footer.header_text'   => 'nullable|string|max:255',
        'footer.paragraph'     => 'nullable|string',
        'footer.sections'      => 'nullable|json',
        'footer.social_icons'  => 'nullable|json',
        'footer.status'        => 'required|boolean',
    ];
    $validatedFooter = $request->validate($footerRules);
    $footerData = $validatedFooter['footer']; // Extract nested array

    // Convert JSON fields for footer if not empty
    if (!empty($footerData['sections'])) {
        $footerData['sections'] = json_decode($footerData['sections'], true);
    }
    if (!empty($footerData['social_icons'])) {
        $footerData['social_icons'] = json_decode($footerData['social_icons'], true);
    }

    // --- Process Header ---
    if ($request->hasFile('header.logo')) {
        $header = Header::first();
        if ($header && $header->logo && \Storage::disk('public')->exists($header->logo)) {
            \Storage::disk('public')->delete($header->logo);
        }
        $headerData['logo'] = $request->file('header.logo')->store('header', 'public');
    } else {
        $headerData['logo'] = $request->input('header.current_logo');
    }

    // Update or create Header record
    $header = Header::first();
    if ($header) {
        $header->update($headerData);
    } else {
        Header::create($headerData);
    }

    // --- Process Footer ---
    if ($request->hasFile('footer.logo')) {
        $footer = Footer::first();
        if ($footer && $footer->logo && \Storage::disk('public')->exists($footer->logo)) {
            \Storage::disk('public')->delete($footer->logo);
        }
        $footerData['logo'] = $request->file('footer.logo')->store('footer', 'public');
    } else {
        $footerData['logo'] = $request->input('footer.current_logo');
    }

    // Update or create Footer record
    $footer = Footer::first();
    if ($footer) {
        $footer->update($footerData);
    } else {
        Footer::create($footerData);
    }

    return redirect()->back()->with('success', 'Header & Footer updated successfully.');
}



}
