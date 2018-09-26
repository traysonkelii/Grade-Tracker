<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
