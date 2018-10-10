<?php

namespace App\Http\Controllers;

use App\Composer as Composer;
use App\Genre as Genre;
use App\Instrument as Instrument;
use App\Student as Student;
use App\Teacher as Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct(Student $student, Teacher $teacher,
        Composer $composer, Instrument $instrument, Genre $genre) {
        $this->student = $student;
        $this->teacher = $teacher;
        $this->composer = $composer;
        $this->instrument = $instrument;
        $this->genre = $genre;
    }

    /**
     * returns the landing page view for a student
     */
    public function landing($student_id, Request $request)
    {
        if ($request->isMethod("post")) {
            $student = $this->student->find($student_id);
            $data['teachers'] = $student->teachers;
            $data['major'] = $student->major;
            $data['repertoires'] = $student->repertoires;
            $data['student'] = $student;
            $data['stat'] = 'teacher';
            return view('contents/student/student', $data);
        } else {
            $student = $this->student->find($student_id);
            $data['teachers'] = $student->teachers;
            $data['major'] = $student->major;
            $data['repertoires'] = $student->repertoires;
            $data['student'] = $student;
            $data['stat'] = 'student';
            return view('contents/student/student', $data);
        }
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
