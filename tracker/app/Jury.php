<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    public function grades()
    {
        return $this->belongsToMany('App\Grade', 'grade_jury', 'jury_id', 'grade_id');
    }
}
