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

    public function createFormAttribute(Request $request) {
        $data = DB::table('attributes')->insertGetId(
            [
                'name' => $request->name,
                'description' => $request->desc,
                'type' => $request->type,
                'scope' => $request->scope,
                'max' => $request->max,
                'min' => $request->min,
                'selections' => $request->selections,
                'person' => $request->person,
            ]
        );
        return response()->json($data);
    }

    public function createForm(Request $request) {
        $data = [];
        $data['form_id'] = DB::table('forms')->insertGetId(
            [
                'name' => $request->name,
                'attribute_array' => $request->att,
                'department_id' => $request->dept,
            ]
        );
        $data['department_id'] = $request->dept;
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
