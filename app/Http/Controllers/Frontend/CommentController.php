<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        // Validate the comment content
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new comment
        Comment::create([
            'post_id'           => $postId,
            'user_id'           => Auth::id(),
            'parent_comment_id' => $request->input('parent_comment_id'), // Optional: for reply
            'content'           => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }
}
