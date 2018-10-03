<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    public function repertoire()
    {
        return $this->hasMany('App\Repertoire', 'genre_id');
    }

    public function getGenre($genre_id)
    {
        $genre = DB::table('genres')->find($genre_id);
        return $genre;
    }

}
