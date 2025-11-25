<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'responses';
    protected $guarded = [];

    public function questionResponse()
    {
        return $this->belongsToMany(Question::class, 'question_response', 'question_id', 'response_id', 'score');
    }
}
