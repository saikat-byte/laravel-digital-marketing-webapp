<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
   // Display a listing of the reviews.
   public function index()
   {
       $reviews = Review::latest()->paginate(10);
       return view('admin.modules.reviews.index', compact('reviews'));
   }

   // Show the form for creating a new review.
   public function create()
   {
       return view('admin.modules.reviews.create');
   }

   // Store a newly created review in storage.
   public function store(Request $request)
   {
       $validated = $request->validate([
           'client_name'    => 'required|string|max:255',
           'client_comment' => 'required|string',
           'rating'         => 'required|integer|min:1|max:5',
           'client_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       // Handle file upload if exists
       if ($request->hasFile('client_image')) {
           $image = $request->file('client_image');
           $filename = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('assets/image/reviews/'), $filename);
           $validated['client_image'] = 'assets/image/reviews/' . $filename;
       }

       Review::create($validated);

       return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
   }

   // Display the specified review.
   public function show(Review $review)
   {
       return view('admin.modules.reviews.show', compact('review'));
   }

   // Show the form for editing the specified review.
   public function edit(Review $review)
   {
       return view('admin.modules.reviews.edit', compact('review'));
   }

   // Update the specified review in storage.
   public function update(Request $request, Review $review)
   {
       $validated = $request->validate([
           'client_name'    => 'required|string|max:255',
           'client_comment' => 'required|string',
           'rating'         => 'required|integer|min:1|max:5',
           'client_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       // If new image uploaded, delete old image if exists and update.
       if ($request->hasFile('client_image')) {
           if ($review->client_image && file_exists(public_path($review->client_image))) {
               unlink(public_path($review->client_image));
           }
           $image = $request->file('client_image');
           $filename = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('assets/image/reviews/'), $filename);
           $validated['client_image'] = 'assets/image/reviews/' . $filename;
       }

       $review->update($validated);

       return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
   }


   // Remove the specified review from storage.
   public function destroy(Review $review)
   {
       // Delete image file if exists
       if ($review->client_image && file_exists(public_path($review->client_image))) {
           unlink(public_path($review->client_image));
       }
       $review->delete();
       return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
   }
}
