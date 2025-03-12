<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'content';

    protected $fillable = [
        'category_id',
        'type',
        'title',
        'slug',
        'content',
        'cover',
        'banner_image',
        'status',
        'published_at',
        'likes_count',
        'comments_count',
        'meta_title',
        'meta_description',
        'meta_keywords',

    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
