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
        return new StudentHomeResponse($student_id);
    }

}
