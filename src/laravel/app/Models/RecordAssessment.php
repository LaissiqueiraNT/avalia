<?php

namespace App\Models;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordAssessment extends Model
{
    protected $table = 'record_assessments';
    protected $guarded = [];


    public const TEST_TYPES = [
        1 => 'A2',
        2 => 'A3',
    ];
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }
}
