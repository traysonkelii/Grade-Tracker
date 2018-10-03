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

    public function getDepartment($depatment_id)
    {
        $department = DB::table('departments')->find($depatment_id);
        return $department;
    }
}
