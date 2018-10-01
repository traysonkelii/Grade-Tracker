<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;

class StudentController extends Controller
{

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * returns the landing page view for a student
     */
    public function landing()
    {
        //this is hardcoded but we will get it from  log in
        $data = [];
        $student_id = "traysonk";
        $teacher_obj = $this->student->getTeacherObject($student_id);
        $teacher = $teacher_obj->first_name;
        $major = $this->student->getMajor($student_id);
        $data['teacher'] = $teacher;
        $data['student_id'] = $student_id;
        $data['major'] = $major;
        $data['firstName'] = $this->student->getFirstName($student_id);

        return view('contents/student/student', $data);

    }

    /**
     * Returns all students 
     */
    public function index()
    {
        $data = [];

        $data['students'] = $this->student->all();
        //get all repertoires for the given student

        return view('contents/student/allStudents', $data);
    }

    /**
     * Returns a certain students list of repertoires
     * @param string $id: student_id
     * @return array []: repertoires 
     */
    public function showRep($student_id){

        $data = [];
        $repertoires = $this->student->getRepertoires($student_id);
        $my_name = $this->student->find($student_id)->first_name;
        $data['my_name'] = $my_name;
        $data['repertoires'] = $repertoires;
       

        return view('contents/student/studentRepertoires', $data);
    }
}
