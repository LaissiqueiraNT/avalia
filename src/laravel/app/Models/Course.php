<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = [];

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'disc_courses', 'course_id', 'discipline_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'enrollment', 'course', 'user_id');
}
}
