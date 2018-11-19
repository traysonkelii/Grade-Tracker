<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Composer;

class ComposerController extends Controller
{

    public function __construct(Composer $composer) {
        $this->composer = $composer;
    }

    public function create($composerName)
    {
        $update = $this->composer->create($composerName);
        return response()->json($update);
    }
}
