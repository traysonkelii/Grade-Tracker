<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function students()
    {
        
        return $this->belongsToMany('App\Student', 'course_student', 'course_id', 'student_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'course_teacher', 'course_id', 'teacher_id');
    }
}
