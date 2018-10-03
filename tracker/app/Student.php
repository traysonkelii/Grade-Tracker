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

    //database functions

    public function getStudent($student_id)
    {
        $student = DB::table('students')->find($student_id);
        return $student;
    }

    public function getTeacherIds($student_id)
    {
        $teacher_ids = [];
        $pivot_obj = DB::table('student_teacher')->where('student_id',$student_id)->get();
        foreach($pivot_obj as $obj)
        {
            $teacher_id = $obj->teacher_id;   
            array_push($teacher_ids, $teacher_id);
        }
        return $teacher_ids;
    }

    public function getRepertoires($student_id)
    {
        $repertoires = [];
        $rep_id = DB::table('repertoire_student')
            ->where('student_id', $student_id)
            ->get();
        foreach ($rep_id as $rep) {
            $repertoire = DB::table('repertoires')->find($rep->repertoire_id);
            array_push($repertoires, $repertoire);
        }
        return $repertoires;
    }

    public function getFirstName($student_id)
    {
        $name = DB::table('students')->find($student_id);  
        return $name->first_name;
    }

    public function getMajor($student_id)
    {
        $student_obj = DB::table('students')->find($student_id);
        $major_id = $student_obj->major_id;
        $major = DB::table('major')->find($major_id);
        $major_id = $major->name;
        return $major_id;
    }

    //NEED TO HAVE GRADE TABLE WORKING BEFORE DOING THISONE
    public function getGrades($student_id)
    {
        $data = [];
        $grade_id = DB::table('grades')->where('student_id', $student_id)->get();
        foreach ($grade_id as $id) 
        {
            array_push($grades, $id->value);
        }
    }

}
