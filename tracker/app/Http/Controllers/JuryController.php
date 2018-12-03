<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;

class JuryController extends Controller
{
    public function formBuilder()
    {
        $data = [];
        $data['welcome'] = 'Lets build this form';
        $data['forms'] = Form::readAll();
        return view('contents/jury/form', $data);
    }
}
