<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSectionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_section_id',
        'key',
        'value',
        'value_type',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    // Relationships
    public function section()
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

    // Value Accessor
    public function getProcessedValueAttribute()
    {
        return $this->formatValue($this->value, $this->value_type);
    }

    protected function formatValue($value, $type)
    {
        switch ($type) {
            case 'json':
            case 'array':
                return json_decode($value, true);
            case 'boolean':
                return (bool) $value;
            case 'number':
                return (float) $value;
            case 'date':
                return \Carbon\Carbon::parse($value);
            case 'file':
                return asset('storage/' . $value);
            default:
                return $value;
        }
    }
}
