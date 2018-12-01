<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PerformanceAttributes extends Model
{
    public function performance()
    {
        return $this->belongsTo('App\Performance', 'performance_id');
    }
}
