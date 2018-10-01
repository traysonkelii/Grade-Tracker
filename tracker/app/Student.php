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

    // public function grades()
    // {
    //     return $this->hasMany('App\Grade', 'student_id');
    // }

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id');
    }

    //database functions

    public function getRepertoires($student_id)
    {
        $instruments = [];
        $rep_id = DB::table('repertoire_student')
            ->where('student_id', $student_id)
            ->get();
        foreach ($rep_id as $rep) {
            $instrument = DB::table('repertoires')->where('id', $rep->repertoire_id)->first();
            array_push($instruments, $instrument->name);
        }
        return $instruments;
    }

    public function getFirstName($student_id)
    {
        $name = DB::table('students')->find($student_id);  
        return $name->first_name;
    }

    public function getTeacherObject($student_id)
    {
        //WILL NEED TO MODIFY FOR MULTIPLE TEACHERS CORNER CASE LATER
        $pivot_obj = DB::table('student_teacher')->where('student_id',$student_id)->first();
        $teacher_id = $pivot_obj->teacher_id;
        $teacher = DB::table('teachers')->find($teacher_id);
        return $teacher;
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
