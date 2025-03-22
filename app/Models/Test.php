<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['category_id', 'title', 'duration', 'image', 'video'];

    protected $casts = [
        'duration' => 'integer',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
