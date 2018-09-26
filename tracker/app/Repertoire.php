<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Repertoire extends Model
{

    public function students()
    {
        return $this->belongsToMany('App\Student', 'repertoire_student', 'repertoire_id', 'student_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade', 'repertoire_id');
    }

    public function getRepertoires($student_id)
    {
        $data = [];
        $rep_id = DB::table('repertoire_student')
            ->where('student_id', $student_id)
            ->get();
        foreach ($rep_id as $id) {
            
        }
    }
}
