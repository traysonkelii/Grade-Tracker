<?php

namespace App\Http\Controllers;

use App\Composer as Composer;
use App\Genre as Genre;
use App\Instrument as Instrument;
use App\Student as Student;
use App\Teacher as Teacher;
use App\Repertoire as Repertoire;
use App\Http\Controllers\IUser;
use Illuminate\Http\Request;
use App\Http\Responses\testResponse;
use App\Http\Responses\Student\StudentHomeResponse;

class StudentController extends Controller
{

    public function __construct(Student $student, Teacher $teacher, Repertoire $repertoire) {
        $this->student = $student;
        $this->teacher = $teacher;
        $this->repertoire = $repertoire;
    }

    public function home($student_id, Request $request)
    {
        $status = $request->input('status');
        $netid = $request->input('netid');
        return new StudentHomeResponse($student_id, $status, $netid);
    }

    public function getStudentByDeptNum($num)
    {
        $students = Student::select('id')->where('department_id', $num)->get();
        return response()->json($students);
    }

    public function getTeacherView(Request $request, $student_id)
    {
        $data = [];
        $student = Student::find($student_id);
        $data['student'] = $student;
        $data['reps'] = $student->repertoires;
        return view('contents/student/teacher-view', $data);
    }
    
}
