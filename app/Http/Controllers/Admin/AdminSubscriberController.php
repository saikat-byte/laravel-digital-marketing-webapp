<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.modules.subscriber.index', compact('subscribers'));
    }

    // Edit pdf file
    public function showPdf()
    {
        // check public/documents/welcome.pdf
        $pdfPath = public_path('documents/welcome.pdf');

        if (!file_exists($pdfPath)) {
            //if file not exists then return view with false
            return view('admin.modules.subscriber.edit_pdf', [
                'pdfExists' => false
            ]);
        }

        // Blade view with true and pdf path to show the pdf
        return view('admin.modules.subscriber.edit_pdf', [
            'pdfExists' => true,
            'pdfPath'   => asset('documents/welcome.pdf'),
            // asset()  URL,
            // Use <iframe> or <embed> or <a href="...">
        ]);
    }

    public function updatePdf(Request $request)
    {
        //  Validate file exists and is a PDF
        //`enctype="multipart/form-data"` in the form
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:20480',
            // mimes:pdf => PDF only
            // max:20480 => 20MB
        ]);

        $pdfPath = public_path('documents/welcome.pdf');

        // Delete the existing PDF file
        if (File::exists($pdfPath)) {
            File::delete($pdfPath);
        }

        // new PDF same path save as 'welcome.pdf'
        $request->file('pdf')->move(public_path('documents'), 'welcome.pdf');

        //success message
        return redirect()
            ->route('admin.edit.showPdf')
            ->with('success', 'PDF file has been updated successfully!');
    }

}
