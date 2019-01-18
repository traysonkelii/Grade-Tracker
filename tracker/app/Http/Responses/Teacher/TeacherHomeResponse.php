<?php

namespace App\Http\Responses\Teacher;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Teacher;
use App\Form;
use App\Performance;
use App\Instrument;
use App\Department;

class TeacherHomeResponse implements Responsable
{

    protected $teacher;

    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function toResponse($request)
    {
        $data = [];
        $data = $this->prepTeacher($this->teacher);
        $this->syncStudents($this->teacher);
        return view('contents/teacher/teacher', $data);
    }

    private function prepTeacher($teacher)
    {
        $data = [];
        $students = $teacher->students;
        $data['students'] = $students;
        $data['teacher'] = $teacher;
        $data['permissions'] = $teacher->permissions;
        $data['netid'] = $teacher->id;
        $data['courses'] = $teacher->courses;
        $data['model_department'] = new Department;
        $data['model_instrument'] = new Instrument;
        return $data;
    }

    private function syncStudents($teacher)
    {
        $students = $teacher->students;
        $teacher_dept = $teacher->department_id;
        $form = Form::select()
        ->where('department_id', $teacher_dept)
        ->where('active',1)
        ->first();
        $pivot = DB::table('student_teacher')->get();
        foreach($students as $student)
        {
            $realtionship = $pivot->where('student_id', $student->id)
            ->where('teacher_id', $teacher->id)
            ->first();

            if ($realtionship->department_id != $teacher_dept)
            {
                DB::table('student_teacher')
                ->where('student_id', $student->id)
                ->where('teacher_id', $teacher->id)
                ->update(['department_id' => $teacher_dept]);
            }

            if ($form)
            {
                $hasForm = Performance::select('id')
                ->where('student_id', $student->id)
                ->where('form_id', $form->id)
                ->first();
                
                if (!$hasForm)
                {
                    Performance::createNew($form->id, $student->id);
                }
            }
        }
    }
 
}
