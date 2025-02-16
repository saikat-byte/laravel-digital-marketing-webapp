<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCommentController extends Controller
{
    public function index(Request $request)
    {
        // Filtering:  query parameter status filter
        $status = $request->input('status'); // 0: pending, 1: approved
        $commentsQuery = Comment::with('user', 'post')->orderBy('created_at', 'desc');
        if ($status !== null) {
            $commentsQuery->where('status', $status);
        }
        $comments = $commentsQuery->paginate(20);

        return view('admin.modules.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['status' => 1]);

        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    // rating store
    public function store(Request $request, $postId)
    {
        // Validate the input fields including rating (optional)
        $request->validate([
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Create the comment in the database
        Comment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'parent_comment_id' => $request->input('parent_comment_id'), // null if top-level comment
            'content' => $request->input('content'),
            'rating' => $request->input('rating'), // This will be stored as an integer (1 to 5)
            'status' => 0, // Default to 0, meaning pending approval
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully and is pending approval.');
    }
}
