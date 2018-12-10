<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormBuilderController extends Controller
{
    public function readFormAttribute($att, $type, $scope){
        $data = DB::table('form_attribute')->select('id')
        ->where('attribute', $att)
        ->where('type', $type)
        ->where('scope', $scope)
        ->get();
        return response()->json($data);
    }

    public function createFormAttribute($name, $desc, $type, $scope, $max, $min, $selections, $person) {
        $data = DB::table('attributes')->insertGetId(
            [
                'name' => $name,
                'description' => $desc,
                'type' => $type,
                'scope' => $scope,
                'max' => $max,
                'min' => $min,
                'selections' => $selections,
                'person' => $person,
            ]
        );
        return response()->json($data);
    }

    public function createForm($name, $attributes) {
        $data = DB::table('forms')->insertGetId(
            [
                'name' => $name,
                'attribute_array' => $attributes
            ]
        );
        return response()->json($data);
    }

    public function viewForm($id) {
        $data = [];
        $form = DB::table('forms')->where('id',$id)->get()->first();
        $data['form'] = $form;
        $data['edit'] = 0;
        return view('/contents/jury/form-view', $data);
    }

    public function submitForm($id) {
        $data = [];
        $form = DB::table('forms')->where('id',$id)->get()->first();
        $data['form'] = $form;
        $data['edit'] = 1;
        return view('/contents/jury/form-view', $data);
    }

    public function getAttribute($id) {
        $att = DB::table('attributes')->where('id', $id)->get()->first();
        return response()->json($att);
    }
}
