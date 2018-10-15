<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Student as Student;

class Repertoire extends Model
{

    public function students()
    {
        return $this->belongsToMany('App\Student', 'repertoire_student', 'repertoire_id', 'student_id')
        ->withPivot('status','jury','recital');
    }

    public function instrument()
    {
        return $this->belongsTo('App\Instrument', 'instrument_id');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genre_id');
    }

    public function composer()
    {
        return $this->belongsTo('App\Composer', 'composer_id');
    }

    public function updateStatus($rep_id,$student_id,$status)
    {
        $pivot = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $rep_id)
        ->update(['status' => $status]);
    }

    public function approve($repertoire_id, $student_id, $type)
    {
        $pivot = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $rep_id)
        ->update([$type => '3']);
    }

    static public function filterByStatus($student_id, $status)
    {
        $pivot = DB::table('repertoire_student')
        ->where('student_id', $student_id)
        ->where('status', $status)
        ->get();
        return $pivot;
    }

    static public function getJuried($student_id, $type)
    {
        $pivot = DB::table('repertoire_student')
        ->where('student_id', $student_id)
        ->where('jury', '!=', 0)
        ->get();
        return $pivot;
    }

    static public function assignStatus($num)
    {
        switch ($num) {
            case '0':
                return 'Not submitted';
            case '1':
                return 'Submitted';
            case '2': 
                return 'Approved';
            case '3':
                return 'Performed';
            case '4': 
                return 'Not Approved';
            default:
                return 'Error in status assignemnt';
        }
    }
}
