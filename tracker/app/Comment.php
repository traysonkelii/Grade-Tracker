<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    //
    public static function getAllComments($rep_stu_id)
    {
        $data = DB::table('comments')->select()->where('rep_stu_id',$rep_stu_id)->get();
        return response()->json($data);
    }
}
