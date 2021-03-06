<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Form;
use App\Student;
use App\Teacher;
use App\Department;

class JuryController extends Controller
{
    public function formBuilder()
    {
        $data = [];
        $data['forms'] = Form::readAll();
        $data['department'] = Department::get();
        return view('contents/jury/form', $data);
    }

    public function formAssign()
    {
        $data = [];
        $data['forms'] = Form::readAll();
        $data['jury'] = Teacher::get();
        $data['students'] = Student::get();
        return view('contents/jury/assign', $data);
    }

    public function gradeStudent($id)
    {
        $data = [];
        $data['student'] = Student::find($id);
        return view('contents/jury/grade', $data);
    }
}
