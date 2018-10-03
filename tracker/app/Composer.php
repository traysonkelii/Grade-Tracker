<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Composer extends Model
{
    public function repertoire(){
        return $this->hasMany('App\Repertoire', 'composer_id');
    }

    public function getComposer($composer_id)
    {
        $composer = DB::table('composers')->find($composer_id);
        return $composer;
    }
}
