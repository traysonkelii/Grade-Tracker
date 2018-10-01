<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    public function repertoire()
    {
        return $this->hasMany('App\Repertoire', 'instrument_id');
    }
}
