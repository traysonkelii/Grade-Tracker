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

    static public function updateStatus($student_id, $repertoire_id, $type, $val)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => $val]);
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
