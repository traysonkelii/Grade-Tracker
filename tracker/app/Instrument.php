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

    public function getInstrument($instrument_id)
    {
        $instrument = DB::table('instruments')->find($instrument_id);
        return $instrument;
    }
}
