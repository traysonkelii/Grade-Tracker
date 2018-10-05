<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Major extends Model
{
    public function student()
    {
        return $this->hasMany('App\Student', 'major_id');
    }
}
