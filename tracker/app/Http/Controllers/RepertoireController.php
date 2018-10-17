<?php

namespace App\Http\Controllers;

use App\Repertoire as Repertoire;
use App\Student as Student;

class RepertoireController extends Controller
{

    public function __construct(Student $student, Repertoire $repertoire) {
        $this->student = $student;
        $this->repertoire = $repertoire;
    }

    public function index($student_id)
    {
        $data = [];
        $current = $this->student->find($student_id);
        $data['student'] = $current;

        return view('contents/repertoire/repertoire', $data);
    }

    public function submit($student_id, $repertoire_id)
    {
        $data = [];
        $status = 'submitted';

        $current = $this->repertoire->find($repertoire_id);
        $updated = $current->updateStatus($repertoire_id, $student_id, $status);
        $pivot = $current->students->where('id', $student_id)->first();
        $newStatus = $pivot->pivot->status;
        $data['repertoire'] = $current;
        $data['status'] = $newStatus;

        return view('contents/repertoire/updated', $data);
    }

    public function filter($student_id, $type)
    {
        $data = [];
        $repertoires = [];
        $pivot = $this->repertoire->filterByStatus($student_id, $type);
        $student = $this->student->find($student_id);

        if ($pivot) {
            foreach ($pivot as $piv) {
                $rep = $this->repertoire($piv->repertoire_id);
                array_push($repertoires, $rep);
            }
        }
        $data['type'] = $type;
        $data['student'] = $student;
        $data['repertoires'] = $repertoires;

        return view('contents/repertoire/filter', $data);
    }

    public function updateStatus($student_id, $repertoire_id, $type, $val)
    {
        $update = $this->repertoire->updateStatus($student_id, $repertoire_id, $type, $val);
        return null;
    }
}
