<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Composer;

class ComposerController extends Controller
{

    public function create($composerName)
    {
        $update = Composer::create($composerName);
        return response()->json($update);
    }
}
