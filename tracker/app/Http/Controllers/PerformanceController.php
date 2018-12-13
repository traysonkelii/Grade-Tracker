<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Performance;
class PerformanceController extends Controller
{
    public function addToPerformance(Request $request)
    {
        $data = Performance::insertGetId(
            [
                'form_id' => $request->form,
                'student_id' => $request->student,
                'jury_array_id' => $request->jury,
            ]
        );
        return response()->json($data);
    }
}
