<?php

namespace App\Http\Responses\Student;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use App\Student;

class StudentLandingResponse implements Responsable
{

    protected $student_id;

    public function __construct($student_id)
    {
        $this->student_id = $student_id;
    }

    public function toResponse($request)
    {
        $data = [];
        if ($request->isMethod("post")) {
            $data['stat'] = 'teacher';
        } else {
            $data['stat'] = 'student';
        }

        $student = Student::find($this->student_id);
        $data['all'] = $student->repertoires;
        $data['jury'] = $this->getTypeRepertoires($student->repertoires, $student->id, 'jury');
        $data['recital'] = $this->getTypeRepertoires($student->repertoires, $student->id, 'recital');
        $data['unsubmitted'] = $this->getUnsubmitted($student->repertoires, $student->id);
        $data['student'] = $student;
        return view('contents/student/student', $data);
    }

    protected function getTypeRepertoires($reps, $studentId, $type)
    {
        $typeReps = [];
        foreach ($reps as $rep)
        {
            if ($rep->students
            ->where('id',$studentId)
            ->first()->pivot->$type != 0)
            {
                array_push($typeReps, $rep);
            }
        }
        return $typeReps;
    } 

    protected function getUnsubmitted($reps, $studentId)
    {
        $typeReps = [];
       
        foreach ($reps as $rep)
        {   
            if ($rep->students->where('id',$studentId)
            ->first()->pivot->recital == 0 && $rep->students
            ->where('id',$studentId)
            ->first()->pivot->jury == 0)
            {
                array_push($typeReps, $rep);
            }
        }
        return $typeReps;
    } 


}
