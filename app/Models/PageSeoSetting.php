<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
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
        'structured_data' => 'array'
    ];

    // Relationships
    public function page()
    {
        return $this->belongsTo(Page::class);
    }



    // Helper Methods
    public function getMetaTags(): array
    {
        return [
            'title' => $this->meta_title,
            'description' => $this->meta_description,
            'keywords' => $this->meta_keywords,
            'og:title' => $this->og_title ?? $this->meta_title,
            'og:description' => $this->og_description ?? $this->meta_description,
            'og:image' => $this->og_image ? asset('storage/' . $this->og_image) : null,
            'twitter:card' => $this->twitter_card ?? 'summary',
            'twitter:title' => $this->twitter_title ?? $this->meta_title,
            'twitter:description' => $this->twitter_description ?? $this->meta_description,
            'twitter:image' => $this->twitter_image ? asset('storage/' . $this->twitter_image) : null,
            'canonical' => $this->canonical_url
        ];
    }

    public function getStructuredDataHtml(): string
    {
        if (empty($this->structured_data)) {
            return '';
        }

        return '<script type="application/ld+json">' . json_encode($this->structured_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }

}
