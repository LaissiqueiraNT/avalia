<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scheduling extends Model
{
    protected $table = 'schedulings';
    protected $guarded = [];
    
    protected $casts = [
        'scheduling' => 'datetime',
    ];

    /**
     * Relacionamento com o usuário (professor)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com a disciplina
     */
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    /**
     * Relacionamento com a avaliação
     */
    public function assessment(): BelongsTo
    {
        return $this->belongsTo(\App\Models\RecordAssessment::class, 'assessment_id');
    }
}
