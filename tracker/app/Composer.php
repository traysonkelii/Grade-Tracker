<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Composer extends Model
{
    public function repertoire(){
        return $this->hasMany('App\Repertoire', 'composer_id');
    }

    public function create($name)
    {
        $update = DB::table('composers')->insertGetId(
            ['name' => $name]
        );
        return $update;
    }
}
