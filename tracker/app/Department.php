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

    static public function getDepartmentName($id)
    {
        $update = DB::table('departments')
        ->select('name')
        ->where('id', $id)
        ->first();
        return $update->name;
    }
}
