<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuryController extends Controller
{
    public function formBuilder()
    {
        $data = [];
        $data['welcome'] = 'Lets build this form';
        return view('contents/jury/form', $data);
    }
}
