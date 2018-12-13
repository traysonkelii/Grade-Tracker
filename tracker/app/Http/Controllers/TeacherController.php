<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Teacher as Teacher;

class TeacherController extends Controller
{

    public function __construct(Student $student, Teacher $teacher)
    {
        $this->student = $student;
        $this->teacher = $teacher;
    }

    public function getTeacherByDeptNum($num)
    {
        $teachers = Teacher::select('id')->where('department_id',$num)->get();
        return response()->json($teachers);
    }

    // we will need a net id of teacher for the teacher landing page
    public function landing()
    {
        $data = [];
        $teacher = $this->teacher->find('cbarker');
        $students = $teacher->students;
        $data['students'] = $students;
        $data['teacher'] = $teacher;
        return view('contents/teacher/teacher', $data);
    }
}
