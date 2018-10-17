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

    static public function submit($student_id, $repertoire_id, $type)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => '1']);
        return $update;
    }


    static public function approve($student_id, $repertoire_id, $type)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => '2']);
        return $update;
    }

    static public function unapprove($student_id, $repertoire_id, $type)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => '4']);
        return $update;
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
