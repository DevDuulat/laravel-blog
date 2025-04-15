<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasFactory, HasUuids, HasTranslations;

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
        'title' => 'array',
        'slug' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
    ];


    public $translatable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function getTranslatedSlug(): ?string
    {
        return $this->getTranslation('slug', app()->getLocale());
    }

    public function getTranslatedTitle(): ?string
    {
        return $this->getTranslation('title', app()->getLocale());
    }

    public function getTranslatedContent(): ?string
    {
        return $this->getTranslation('content', app()->getLocale());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
