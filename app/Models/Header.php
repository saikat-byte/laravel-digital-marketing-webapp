<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'nav_links',
        'button_text',
        'button_link',
        'status',
    ];

    protected $casts = [
        'nav_links' => 'array',
        'status'    => 'boolean',
    ];
}
