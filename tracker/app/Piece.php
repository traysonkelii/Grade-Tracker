<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    public function jury()
    {
        return $this->belongsTo('App\Teacher', 'jury_id');
    }

    public function performance()
    {
        return $this->belongsTo('App\Performance', 'performance_id');
    }
}
