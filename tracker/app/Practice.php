<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Practice extends Model
{
    public function store($rep_stu_id, $start, $stop)
    {
        $practice_id = DB::table('practice')->insertGetId(
            ['rep_stu_id' => $rep_stu_id, 
            'practice_start' => $start, 
            'practice_stop' => $stop ]
        );
    }

    public function getAllPractices($rep_stu_id)
    {
        $practice_numbers = DB::table('practice')
        ->where('rep_stu_id',$rep_stu_id)
        ->get();
        return $practice_id;
    }

}
