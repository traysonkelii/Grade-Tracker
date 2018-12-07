<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Teacher as Teacher;
use App\Http\Responses\Student\StudentHomeResponse;

class ContentsController extends Controller
{
    public function __construct(Student $student, Teacher $teacher)
    {
        $this->student = $student;
        $this->teacher = $teacher;
    }
    //
    public function home(Request $request)
    {
        $data = [];
        $status = $request->input('status');
        $netid = $request->input('netid');
        if ($status)
        {
            $teacher = $this->teacher->find($netid);
            $data = $this->prepTeacher($teacher);
            return view('contents/teacher/teacher', $data);
        }
        else 
        {
            return new StudentHomeResponse($netid, $status, $netid);
        }
        return view('contents/home', $data);
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

        if ($type == "students")
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

        else 
        {
            $teacher = $this->teacher->find($netid);
            if ($teacher)
            {
                $data = $this->prepTeacher($teacher);
                return view('contents/teacher/teacher', $data);
            }
            else 
            {
                abort(404);
            }
        }
    }

    protected function prepTeacher($teacher)
    {
        $data = [];
        $students = $teacher->students;
        $data['students'] = $students;
        $data['teacher'] = $teacher;
        $data['permissions'] = $teacher->permissions;
        $data['netid'] = $teacher->id;
        return $data;
    }
}
