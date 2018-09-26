<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function jurys()
    {
        return $this->belongsToMany('App\Jury', 'grade_jury', 'jury_id', 'grade_id');
    }

    public function students()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function repertoire()
    {
        return $this->belongsTo('App\Repertoire', 'repertoire_id');
    }
}
