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
        ->withPivot('practice','jury','recital','practice_time','rep_stu_id');
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

    public function repCreate($name, $comId, $insId, $genId)
    {
        $update = DB::table('repertoires')->insertGetId(
            ['name' => $name, 'composer_id' => $comId, 'instrument_id' => $insId, 'genre_id' => $genId]
        );
        return $update;
    }

    public function repCreatePivot($stu_id, $rep_id)
    {
        $update = DB::table('repertoire_student')->insertGetId(
            ['student_id' => $stu_id, 'repertoire_id' => $rep_id]
        );
        return $update;
    }

    public function readRepCheck($id, $com_id, $ins_id, $gen_id)
    {
        $update = DB::table('repertoires')->select('id')
        ->where('id', $id)
        ->where('composer_id', $com_id)
        ->where('instrument_id', $ins_id)
        ->where('genre_id', $gen_id)
        ->first();
        return response()->json($update);
    }

    static public function updateStatus($student_id, $repertoire_id, $type, $val)
    {
        $update = DB::table('repertoire_student')
        ->where('student_id',$student_id)
        ->where('repertoire_id', $repertoire_id)
        ->update([$type => $val]);
        return $update;
    }

    static public function repUpdate($rep_stu_id, $type, $val)
    {
        $update = DB::table('repertoire_student')
        ->where('rep_stu_id', $rep_stu_id)
        ->update([$type => $val]);
        return $update;
    }

    static public function repRead($rep_stu_id, $type)
    {
        $read = DB::table('repertoire_student')
        ->select()
        ->where('rep_stu_id', $rep_stu_id)
        ->first()->$type;
        return $read;
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
