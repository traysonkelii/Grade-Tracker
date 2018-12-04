<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function formAssign()
    {
        $data = [];
        $data['forms'] = Form::readAll();
        $data['jury'] = DB::table('teachers')->select()->get();
        $data['students'] = DB::table('students')->select()->get();
        return view('contents/jury/assign', $data);
    }

}
