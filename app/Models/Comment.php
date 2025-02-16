<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_comment_id',
        'content',
    ];

    // Comment এর সাথে User সম্পর্ক (যে ব্যক্তি comment করেছে)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comment এর সাথে Post সম্পর্ক
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Reply (Child Comments) - self-relation
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    // Parent Comment (যদি এই comment reply হয়)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
}
