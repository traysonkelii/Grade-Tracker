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

    // we will need a net id of teacher for the teacher landing page
    public function landing()
    {
        $data = [];
        $students = $this->getMyStudents('byoung','su2018');
        $teacher = $this->teacher->getTeacher('byoung');
        $data['students'] = $students;
        $data['teacher'] = $teacher;
        return view('contents/teacher/teacher', $data);
    }

    public function getMyStudents($teacher_id, $semester)
    {
        $students = [];
        $student_ids = $this->teacher->getStudentIds($teacher_id, $semester);
        foreach($student_ids as $ids)
        {
            $student = $this->student->getStudent($ids);
            array_push($students, $student);
        }
        return $students;
    }
}
