<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Instrument extends Model
{
    public function repertoire()
    {
        return $this->hasMany('App\Repertoire', 'instrument_id');
    }
}
