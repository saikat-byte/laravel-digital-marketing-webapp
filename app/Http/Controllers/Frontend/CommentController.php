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
        $request->validate([
            'content' => 'required|string',
            'rating'  => 'nullable|integer|min:1|max:5',
        ]);

        Comment::create([
            'post_id'           => $postId,
            'user_id'           => Auth::id(),
            'parent_comment_id' => $request->input('parent_comment_id'), // null if top-level
            'content'           => $request->input('content'),
            'rating'            => $request->input('rating'), // rating insert
            'status'            => 0, // pending
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully and is pending approval.');
    }

}
