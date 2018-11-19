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

    public function updateStatus($student_id, $repertoire_id, $type, $val)
    {
        $update = $this->repertoire->updateStatus($student_id, $repertoire_id, $type, $val);
        return null;
    }

    public function update($id, $type, $val)
    {
        $update = $this->repertoire->repUpdate($id, $type, $val);
        return null;
    }

    public function read($id, $type)
    {
        $read = $this->repertoire->repRead($id, $type);
        return $read;
    }

    public function createRep($name, $com_id, $ins_id, $gen_id)
    {
        $update = $this->repertoire->repCreate($name, $com_id, $ins_id, $gen_id);
        return response()->json($update);
    }

    public function createPivot($stu_id, $rep_id)
    {
        $update = $this->repertoire->repCreatePivot($stu_id, $rep_id);
        return response()->json($update);
    }

    public function readRepCheck($id, $com_id, $ins_id, $gen_id)
    {
        $update = $this->repertoire->readRepCheck($id, $com_id, $ins_id, $gen_id);
        return response()->json($update);
    }
}
