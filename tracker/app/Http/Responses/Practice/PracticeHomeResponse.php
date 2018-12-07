<?php

namespace App\Http\Responses\Practice;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use App\Student;

class PracticeHomeResponse implements Responsable
{

    protected $student_id;

    public function __construct($student_id)
    {
        $this->student_id = $student_id;
    }

    public function toResponse($request)
    {
        $data = [];
        $student = Student::find($this->student_id);
        $data['all'] = $student->repertoires;
        $data['student'] = $student;
        if ($request->isMethod('post'))
        {
            $data['permissions'] = $request->input('permissions');
        }
        else {
            $data['permissions'] = $student->permissions;
        }
        return view('contents/practice/home', $data);
    }

}
