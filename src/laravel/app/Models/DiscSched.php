<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscSched extends Model
{
    protected $table = 'disc_sched';
    protected $guarded = [];

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
