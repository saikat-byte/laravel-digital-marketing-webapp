<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_id',
        'name',
        'code',
        'type',
        'order',
        'status',
        'image',
        'multi_image',
        'video',
        'pdf',
        'button_1_text',
        'button_1_link',
        'button_2_text',
        'button_2_link',
        'heading',
        'sub_heading',
        'paragraph',
        'config',           // ✅ Custom Fields (JSON Format)
    ];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'validation_rules'  => 'array',
        'multi_image' => 'array', // Convert JSON to Array
        'config' => 'array',      // Convert JSON to Array
        'status' => 'boolean',    // Status Boolean

    ];

    // Relationships
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function settings()
    {
        return $this->hasMany(PageSectionSetting::class, 'page_section_id');
    }

    // Helper Methods
    public function getSetting($key, $default = null)
    {
        $setting = $this->settings()->where('key', $key)->first();
        return $setting ? $this->formatSettingValue($setting) : $default;
    }

    protected function formatSettingValue($setting)
    {
        switch ($setting->value_type) {
            case 'json':
            case 'array':
                return json_decode($setting->value, true);
            case 'boolean':
                return (bool) $setting->value;
            case 'number':
                return (float) $setting->value;
            case 'date':
                return \Carbon\Carbon::parse($setting->value);
            default:
                return $setting->value;
        }
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', true)
                    ->where(function ($q) {
                        $q->whereNull('published_at')
                          ->orWhere('published_at', '<=', now());
                    });
    }
}
