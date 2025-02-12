<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'code', 'type', 'description',
        'heading', 'sub_heading', 'paragraph', 'order', 'status',
        'validation_rules', 'config', 'image', 'multi_image', 'video',
        'button_1_text', 'button_1_link', 'button_2_text', 'button_2_link', 'pdf'
    ];
    protected $dates = ['deleted_at'];

    protected $casts = [
        'validation_rules' => 'array',
        'config'           => 'array',
        'multi_image'      => 'array',
        'status'           => 'boolean',
    ];


}
