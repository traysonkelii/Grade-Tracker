<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function genre()
    {
        return $this->hasMany('App\Repertoire', 'genre_id');
    }
}
