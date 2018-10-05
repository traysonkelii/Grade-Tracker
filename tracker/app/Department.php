<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Department extends Model
{
    public function teachers()
    {
        return $this->hasMany('App\Teacher', 'department_id');
    }
}
