<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'slug',
        'title',
        'status',
        'description',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    // Auto-generate slug when name is set
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Relationships
    public function sections()
    {
        return $this->hasMany(PageSection::class);
    }

    public function seo()
    {
        return $this->hasOne(PageSeoSetting::class);
    }

    // SEO Accessor Methods
    public function getMetaTitleAttribute()
    {
        return $this->seo?->meta_title ?? $this->title ?? config('app.name');
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->seo?->meta_description ?? Str::limit($this->description, 160);
    }

    public function getMetaKeywordsAttribute()
    {
        return $this->seo?->meta_keywords ?? 'default, keywords, for, website';
    }

    public function getCanonicalUrlAttribute()
    {
        return $this->seo?->canonical_url ?? url($this->slug);
    }


    // Helper Methods
    public function getFullUrlAttribute()
    {
        return url($this->slug);
    }

    public function isPublished()
    {
        return $this->status && $this->sections()->count() > 0;
    }
}
