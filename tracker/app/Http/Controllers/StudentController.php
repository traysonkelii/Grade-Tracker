<?php

namespace App\Http\Controllers;

use App\Composer as Composer;
use App\Genre as Genre;
use App\Instrument as Instrument;
use App\Student as Student;
use App\Teacher as Teacher;
use App\Repertoire as Repertoire;
use Illuminate\Http\Request;
use App\Http\Responses\testResponse;
use App\Http\Responses\Student\StudentLandingResponse;

class StudentController extends Controller
{

    public function __construct(Student $student, Teacher $teacher, Repertoire $repertoire) {
        $this->student = $student;
        $this->teacher = $teacher;
        $this->repertoire = $repertoire;
    }

    /**
     * returns the landing page view for a student
     */
    public function landing($student_id, Request $request)
    {
        return new StudentLandingResponse($student_id);
        // $data = [];
        // // if it came from a teacher
        // if ($request->isMethod("post")) {
        //     $data['stat'] = 'teacher';
        // } else {
        //     $data['stat'] = 'student';
        // }

        // $student = $this->student->find($student_id);
        // $data['repertoires'] = $student->repertoires;
        // $data['jury'] = 
        // $data['student'] = $student;
        // $model = $this->repertoire;
        // return view('contents/student/student', $data)->withModel($model);
    }



    /**
     * Returns all students
     */
    public function index()
    {

        return new testResponse();
        // $data = [];

        // $data['students'] = $this->student->all();
        // //get all repertoires for the given student

        // return view('contents/student/allStudents', $data);
    }

    /**
     * Returns a certain students list of repertoires
     * @param string $id: student_id
     * @return array []: repertoires
     */
    public function showRep($student_id)
    {

        $current_student = $this->student->find($student_id);
        $repertoires = $current_student->repertoires;
        $data = [];
        $data['student'] = $current_student;
        $data['repertoires'] = $repertoires;

        return view('contents/student/studentRepertoires', $data);
    }
}
