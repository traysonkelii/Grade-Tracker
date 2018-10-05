<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    //any table not using an incrementing key should have this set to false.
    public $incrementing = false;

    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'student_teacher', 'student_id', 'teacher_id');
    }

    public function repertoires()
    {
        return $this->belongsToMany('App\Repertoire', 'repertoire_student', 'student_id', 'repertoire_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id');
    }
}
