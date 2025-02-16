<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'parent_comment_id', 'content', 'rating', 'status'];
    protected $casts = [
        'rating' => 'integer',
    ];

    // who using the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // post comment
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Nested replies (child comments)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    // Parent comment reply
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    // Approved comment
public function approvedComments()
{
    return $this->hasMany(Comment::class)->where('status', 1);
}


}
