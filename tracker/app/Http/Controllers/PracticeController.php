<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice as Practice;
use App\Student as Student;
use App\Repertoire as Repertoire;
use App\Http\Responses\Practice\PracticeHomeResponse;

class PracticeController extends Controller
{
    public function __construct(Practice $practice, Repertoire $repertoire){
        $this->practice = $practice;
        $this->repertoire = $repertoire;
    }
    
    public function addPractice($rep_stu_id, $start, $stop)
    {
        $this->practice->store($rep_stu_id, $start, $stop);
    }

    public function home(Request $request, $student_id)
    {
        return new PracticeHomeResponse($student_id);
    }
}