<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'header_text',
        'paragraph',
        'sections',
        'social_icons',
        'status',
    ];

    protected $casts = [
        'sections'     => 'array',
        'social_icons' => 'array',
        'status'       => 'boolean',
    ];
}
