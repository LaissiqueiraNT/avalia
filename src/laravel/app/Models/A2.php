<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class A2 extends Model
{
    protected $table = 'A2';
    protected $guarded = [];

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }
}
