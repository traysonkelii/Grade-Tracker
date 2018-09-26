<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function landing()
    {
        return view('contents/teacher/teacher');
    }
}
