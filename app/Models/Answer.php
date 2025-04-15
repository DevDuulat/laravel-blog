<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Answer extends Model
{
    use HasFactory, HasUuids, HasTranslations;

    protected $fillable = ['question_id', 'answer', 'is_correct', 'group_index'];


    protected $casts = [
        'is_correct' => 'boolean',
        'answer' => 'array',
    ];

    public $translatable = [
        'answer',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
