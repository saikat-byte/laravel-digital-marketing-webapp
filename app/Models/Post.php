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
