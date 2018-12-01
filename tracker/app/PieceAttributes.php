<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PieceAttributes extends Model
{
    public function piece()
    {
        return $this->belongsTo('App\Piece', 'piece_id');
    }
}
