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

    public function index()
    {
        $data = [];

        $data['students'] = $this->student->all();
        return view('contents/student', $data);
    }

    /**
     * @param string $id: student_id
     * @return array []: repertoires 
     */
    public function showRep(Request $request, $id){
        $student = new Student();
        $repertoires = $student->getRepertoires($id);
        return view('contents/teacher', $repertoires);
    }
}
