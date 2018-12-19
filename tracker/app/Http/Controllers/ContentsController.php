<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Teacher as Teacher;
use App\Http\Responses\Student\StudentHomeResponse;
use App\Http\Responses\Teacher\TeacherHomeResponse;

class ContentsController extends Controller
{
    public function __construct(Student $student, Teacher $teacher)
    {
        $this->student = $student;
        $this->teacher = $teacher;
    }

    public function login()
    {
        $data = [];
        return view('contents/login', $data);
    }

    public function landing(Request $request)
    {
        $netid = $request->input('netid');
        $password = $request->input('password');
        $type = $request->input('type');
        $data = [];

        $teacher = $this->teacher->find($netid);
        
        if ($teacher)
        {
            return new TeacherHomeResponse($teacher);
        }

        else 
        {
            $student = $this->student->find($netid);
            if ($student)
            {
                $status = $student->permissions;
                return new StudentHomeResponse($netid, $status);
            }
            else
            {
                abort(404);
            }
        }
    }
}
