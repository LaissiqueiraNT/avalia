<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    protected $table = 'schedulings';
    protected $guarded = [];

    public function discipline()
    {
        return $this->belongsToMany(Discipline::class, 'scheduling_discipline', 'scheduling_id', 'discipline_id');
    }
}
