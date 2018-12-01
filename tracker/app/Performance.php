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
}
