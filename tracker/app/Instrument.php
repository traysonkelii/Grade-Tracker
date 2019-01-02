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

    static public function getInstrumentName($instrument_id)
    {
        $update = DB::table('instruments')
        ->select('name')
        ->where('id', $instrument_id)
        ->first();
        return $update->name;
    }
}
