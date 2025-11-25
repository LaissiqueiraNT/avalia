<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class a3 extends Model
{
    protected $table = 'a3';
    protected $guarded = [];

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }
}
