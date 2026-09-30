<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'client_name',
        'image',
        'description',
        'link',
        'completion_date',
        'is_featured',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
