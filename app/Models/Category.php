<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasUuids, HasTranslations;

    protected $fillable = ['parent_id', 'name', 'slug', 'banner_image', 'category_type', 'is_active'];

    public array $translatable = ['name', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
