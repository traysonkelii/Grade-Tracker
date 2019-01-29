<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $message = $request->input('message');
        $rep_stu_id = $request->input('repStuId');
        $person = $request->input('person');
        $update = DB::table('comments')->insert([
            'rep_stu_id' => $rep_stu_id,
            'value' => $message,
            'person' => $person
        ]);
        return response()->json($update);
    }
}
