<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Composer;
use App\Instrument;
use App\Genre;
use App\Repertoire;

class SearchController extends Controller
{
    public function comAutocomplete(Request $request)
    {
        $data = Composer::select("name")
        ->where("name", "LIKE", "%{$request->input('query')}%")
        ->get();

        return response()->json($data);
    }
    public function insAutocomplete(Request $request)
    {
        $data = Instrument::select("name")
        ->where("name", "LIKE", "%{$request->input('query')}%")
        ->get();

        return response()->json($data);
    }
    public function repAutocomplete(Request $request)
    {
        $rep = Repertoire::select()
        ->where("name", "LIKE", "%{$request->input('query')}%")
        ->get();
        $data = [];
        foreach ($rep as $r) {
            $rep_name = $r->name;
            $composer = $r->composer()->get()->first()->name;
            $instrument = $r->instrument()->get()->first()->name;
            $genre = $r->genre()->get()->first()->name;
            $val = $rep_name ." | ". $composer ." | ". $instrument ." | ". $genre;  
            array_push($data, $val); 
        }
        info($data);
        return response()->json($data);
    }
    public function genAutocomplete(Request $request)
    {
        $data = Genre::select("name")
        ->where("name", "LIKE", "%{$request->input('query')}%")
        ->get();

        return response()->json($data);
    }

    public function getWantedAttribute($table, $wanted, $col, $value)
    {
        $data = DB::table($table)->select($wanted)->where($col, $value)->get()->first();
        return response()->json($data);
    }

    public function getRepertoireIds($value)
    {
        $data = DB::table("repertoires")->select("id")->where("name", $value)->get();
        return response()->json($data);
    }

}
