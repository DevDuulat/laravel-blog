<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'parent_id',
        'category_type',
        'name',
        'slug',
        'banner_image',
        'is_active',
    ];
}
