<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student as Student;
use App\Teacher as Teacher;
use App\Composer as Composer;
use App\Instrument as Instrument;
use App\Genre as Genre;

class StudentController extends Controller
{

    public function __construct(Student $student, Teacher $teacher, 
    Composer $composer, Instrument $instrument, Genre $genre)
    {
        $this->student = $student;
        $this->teacher = $teacher;
        $this->composer = $composer;
        $this->instrument = $instrument;
        $this->genre = $genre;
    }

    /**
     * returns the landing page view for a student
     */
    public function landing()
    {
        //this is hardcoded but we will get it from  log in
        $data = [];
        $teachers = [];
        $student_id = "traysonk";
        $teacher_id = $this->student->getTeacherIds($student_id);
        foreach ($teacher_id as $id)
        {
            $teacher_obj =  $this->teacher->getTeacher($id);
            array_push($teachers, $teacher_obj);
        }
        $major = $this->student->getMajor($student_id);
        $data['teachers'] = $teachers;
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
        $composer = new Composer;
        $genre = new Genre;
        $instrument = new Instrument;

        $data = [];

        $repertoires = $this->student->getRepertoires($student_id);
        foreach($repertoires as $rep)
        {
            $details = [];
            $com = $this->composer->find($rep->composer_id);
            $gen = $this->genre->find($rep->genre_id);
            $inst = $this->instrument->find($rep->instrument_id);
            array_push($details, [$com,$gen,$inst,$rep]);
            $data['piece'] = $details;
        }
        $student = $this->student->getStudent($student_id);
        $data['student'] = $student;

        return view('contents/student/studentRepertoires', $data);
    }
}
