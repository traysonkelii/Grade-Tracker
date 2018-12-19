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
        return $this->belongsToMany('App\Repertoire', 'repertoire_student', 'student_id', 'repertoire_id')
        ->withPivot('practice','jury','recital','practice_time','rep_stu_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id');
    }

    public function performance()
    {
        return $this->hasMany('App\Performance', 'student_id');
    }
    
    static public function updateStatus($student_id, $repertoire_id, $type, $val)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => $val]);
        return $update;
    }

    public function updateCol($id, $col, $val)
    {
        $update = DB::table('students')
        ->where('id',$id )
        ->update([$col => $val]);
        return $update;
    }
}
