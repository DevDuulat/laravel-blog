<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Test extends Model
{
    use HasFactory, HasUuids, HasTranslations;

    protected $fillable = ['category_id', 'title', 'duration', 'image'];

    protected $casts = [
        'duration' => 'integer',
        'title' => 'array',
    ];

    public $translatable = ['title'];

    public function getTitleForSelectAttribute(): string
    {
        $ru = $this->getTranslation('title', 'ru');
        $kg = $this->getTranslation('title', 'kg');

        return "{$ru} / {$kg}";
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
