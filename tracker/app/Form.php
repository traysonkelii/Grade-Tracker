<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Form extends Model
{
    public static function readAll(){
        return DB::table('form')->select()->get();
    }
}
