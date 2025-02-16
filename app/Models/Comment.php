<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'parent_comment_id', 'content'];

    // যে ব্যবহারকারী comment করেছে
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // যে post এ comment করা হয়েছে
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Nested replies (child comments)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    // Parent comment (যদি এই comment reply হয়)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
}
