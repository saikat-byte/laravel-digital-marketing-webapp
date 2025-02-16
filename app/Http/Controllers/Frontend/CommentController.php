<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Ensure only authenticated users can store comments
    public function store(Request $request, $postId)
    {
        // Check if user is logged in (middleware 'auth' usually handles this)
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to comment.');
        }

        // Validate input
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create the comment
        Comment::create([
            'post_id'           => $postId,
            'user_id'           => Auth::id(),
            'parent_comment_id' => $request->input('parent_comment_id'), // For reply, if provided
            'content'           => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }
}
