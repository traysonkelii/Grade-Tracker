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

    public function createFormAttribute($name, $desc, $type, $scope, $max, $min, $selections) {
        $data = DB::table('attributes')->insertGetId(
            [
                'name' => $name,
                'description' => $desc,
                'type' => $type,
                'scope' => $scope,
                'max' => $max,
                'min' => $min,
                'selections' => $selections
            ]
        );
        return response()->json($data);
    }
}
