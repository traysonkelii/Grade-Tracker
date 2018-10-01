<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    public function repertoire(){
        return $this->hasMany('App\Repertoire', 'composer_id');
    }
}
