<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Discipline extends Model
{
    protected $table = 'disciplines';
    protected $guarded = [];
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'disc_courses', 'discipline_id', 'course_id');
    }
    public function schedulings()
    {
        return $this->belongsToMany(Scheduling::class, 'disc_sched', 'discipline_id', 'scheduling_id');
    }
}
