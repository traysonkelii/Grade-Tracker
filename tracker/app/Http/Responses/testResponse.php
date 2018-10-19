<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class testResponse implements Responsable
{
    public function toResponse($request)
    {
        return "when or if controllers get to messy use me!";
    }
}
