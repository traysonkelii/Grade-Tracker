<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    public $incrementing = false;
    protected $table = 'teachers';

    public function departments()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function instrument()
    {
        return $this->belongsTo('App\Instrument', 'instrument_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_teacher', 'teacher_id', 'student_id')
        ->withPivot('instrument_id', 'department_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_teacher', 'teacher_id', 'course_id');
    }
}
