<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice as Practice;

class PracticeController extends Controller
{
    public function __construct(Practice $practice){
        $this->practice = $practice;
    }
    
    public function addPractice($rep_stu_id, $start, $stop){
        $this->practice->store($rep_stu_id, $start, $stop);
    }
}