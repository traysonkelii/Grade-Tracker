<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Form extends Model
{

    public function performance()
    {
        return $this->hasMany('App\Performance', 'form_id');
    }

    public static function readAll()
    {
        return DB::table('forms')->select()->get();
    }
}