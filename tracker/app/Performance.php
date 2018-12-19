<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function form()
    {
        return $this->belongsTo('App\Form', 'form_id');
    }

    public static function createNew($form, $student)
    {   

        $create = DB::table('performances')->insertGetId(
            ['form_id' => $form, 
            'student_id' => $student, 
            'student_response' => 'none']
        );
        return $create;
    }
}
