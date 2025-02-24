<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical_url',
        'structured_data',
    ];

    protected $casts = [
        'structured_data' => 'array',
    ];

    // Relationship: A SEO setting belongs to a Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
