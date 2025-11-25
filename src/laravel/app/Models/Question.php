<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question_descriptions';
    protected $guarded = [];

    public function questionResponse()
    {
        return $this->belongsToMany(Response::class, 'question_response', 'question_id', 'response_id', 'score');
    }
}
