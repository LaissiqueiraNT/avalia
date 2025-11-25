<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionDescription extends Model
{
    protected $table = 'question_descriptions';
    protected $guarded = [];

    public function A2(): BelongsTo
    {
        return $this->belongsTo(a2::class);
    }
    public function A3(): BelongsTo
    {
        return $this->belongsTo(a2::class);
    }
}