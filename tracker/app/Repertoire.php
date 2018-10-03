<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Repertoire extends Model
{

    public function students()
    {
        return $this->belongsToMany('App\Student', 'repertoire_student', 'repertoire_id', 'student_id');
    }

    public function instrument()
    {
        return $this->belongsTo('App\Instrument', 'instrument_id');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genre_id');
    }

    public function composer()
    {
        return $this->belongsTo('App\Composer', 'composer_id');
    }

    public function getRepertoire($repertoire_id)
    {
        $repertoire = DB::table('repertoires')->find($repertoire_id);
        return $repertoire;
    }
}
