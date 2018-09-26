<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentsController extends Controller
{
    //
    public function home()
    {
        $data = [];
        $data['test'] = "hello";
        return view('contents/home', $data);
    }
}
