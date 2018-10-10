<?php

namespace App\Http\Controllers;

use App\Repertoire as Repertoire;
use App\Student as Student;

class RepertoireController extends Controller
{
    //
    public function index($student_id)
    {
        $data = [];
        $Student = new Student();
        $current = $Student->find($student_id);
        $data['student'] = $current;

        return view('contents/repertoire/repertoire', $data);
    }

    public function submit($student_id, $repertoire_id)
    {
        $data = [];
        $Repetoire = new Repertoire();
        $status = 'submitted';

        $current = Repertoire::find($repertoire_id);
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
        $pivot = Repertoire::filterByStatus($student_id, $type);
        $student = Student::find($student_id);

        if($pivot){
            foreach($pivot as $piv)
            {
                $rep = Repertoire::find($piv->repertoire_id);
                array_push($repertoires, $rep);
            }
        }
        $data['type'] = $type;
        $data['student'] = $student;
        $data['repertoires'] = $repertoires;

        return view('contents/repertoire/filter', $data);
    }
}
