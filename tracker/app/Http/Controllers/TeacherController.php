<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as Department;
use App\Instrument as Instrument;
use App\Student as Student;
use App\Teacher as Teacher;
use Illuminate\Support\Facades\DB;


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

    public function goToJury($teacher_id)
    {
        $data = [];
        $teacher = $this->teacher->find($teacher_id);
        $students = $teacher->students;
        $instruments = DB::table('instruments')
        ->select('name')
        ->where('department_id', $teacher->department_id)
        ->get();
        $data['teacher'] = $teacher;
        $data['students'] = $students;
        $data['instruments'] = $instruments;
        $data['model_ins'] = new Instrument;
        $data['model_dep'] = new Department;
        return view('contents/jury/landing', $data);
    }
}
