<?php

namespace App\Http\Responses\Teacher;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use App\Teacher;
use App\Form;
use App\Performance;

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
        return $data;
    }

    private function syncStudents($teacher)
    {
        $students = $teacher->students;
        $teacher_dept = $teacher->department_id;
        $form = Form::select()->where('department_id', $teacher_dept)->first();
        foreach($students as $student)
        {
            if ($student->department_id != $teacher_dept)
            {
                $student->updateCol($student->id, 'department_id', $teacher_dept);
            }
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
