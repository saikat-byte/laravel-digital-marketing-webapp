<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags()
    {

        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {

        return $this->belongsTo(SubCategory::class);
    }
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function seoSetting()
    {
        return $this->hasOne(PostSeoSetting::class);
    }

    // comment relation
    public function comments()
    {
        // Main comment comments ( parent_comment_id null)
        return $this->hasMany(Comment::class)->whereNull('parent_comment_id');
    }

    // all comments
    public function getTotalCommentsAttribute()
    {
        $topLevelCount = $this->comments()->count();
        $replyCount = $this->comments()->with('replies')->get()->sum(function ($comment) {
            return $comment->replies->count();
        });
        return $topLevelCount + $replyCount;
    }


    // comment approved
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('status', 1);
    }


    // Helper method

    public function previous()
    {
        return self::where('status', 1)
            ->where('created_at', '<', $this->created_at)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function next()
    {
        return self::where('status', 1)
            ->where('created_at', '>', $this->created_at)
            ->orderBy('created_at', 'asc')
            ->first();
    }
}
