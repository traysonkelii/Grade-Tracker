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
        return $this->belongsToMany('App\Student', 'student_teacher', 'teacher_id', 'student_id');
    }

    //DB METHODS
    public function getTeacher($teacher_id)
    {
        $teacher = DB::table('teachers')->find($teacher_id);
        return $teacher;
    }

    public function getStudentIds($teacher_id, $semester)
    {
        $student_ids = [];
        $pivot_obj = DB::table('student_teacher')
        ->where('teacher_id', $teacher_id)
        ->where('semester', $semester)
        ->get();
        foreach($pivot_obj as $obj)
        {
            $student_id = $obj->student_id;
            array_push($student_ids, $student_id);
        }
       
        return $student_ids;
    }

}
