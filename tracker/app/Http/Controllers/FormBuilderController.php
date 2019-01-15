<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Form;
use App\Student;
use App\Performance;
use App\Department;

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
                'selections' => $request->selections,
                'person' => $request->person,
                'min' => $request->min,
                'max' => $request->max
            ]
        );
        return response()->json($data);
    }

    public function createForm(Request $request) {
        $data = [];
        DB::table('forms')->where('department_id', $request->dept)
        ->update(['active' => 0]);
        $formId = DB::table('forms')->insertGetId(
            [
                'name' => $request->name,
                'attribute_array' => $request->att,
                'department_id' => $request->dept,
                'active' => 1
            ]
        );
        $data['form_id'] = $formId;
        $data['department_id'] = $request->dept;
        return response()->json($data);
    }

    public function buildForm(Request $request) {
        $data = [];
        $department = Department::get();
        $data['department'] = $department;
        return view('/contents/forms/builder', $data);
    }

    public function getAttribute($id) {
        $att = DB::table('attributes')->where('id', $id)->get()->first();
        return response()->json($att);
    }

    public function viewFormStudent($form_id, $student_id) {
        $data = [];
        $form = DB::table('forms')->where('id',$form_id)->get()->first();
        $performance = DB::table('performances')
        ->where('form_id', $form_id)
        ->where('student_id', $student_id)
        ->get()
        ->first();
        $data['form'] = $form;
        $data['performance'] = $performance;
        $data['student_id'] = $student_id;
        return view('/contents/forms/form-view-student', $data);
    }

    public function submitForm($id) {
        $data = [];
        $form = DB::table('forms')->where('id',$id)->get()->first();
        $data['form'] = $form;
        $data['edit'] = 1;
        return view('/contents/jury/form-view', $data);
    }

    public function studentAnswer(Request $request)
    {
        $form = DB::table('performances')
        ->where('student_id', $request->studentId)
        ->where('form_id', $request->formId)
        ->update(['student_response' => $request->answer]);
        return response()->json($form);
    }

    public function studentFill($id) 
    {
        $data = [];
        $student = Student::find($id);
        $performances = DB::table('performances')
        ->select('form_id')
        ->where('student_id',$id)
        ->get();
        $data['student'] = $student;
        $data['performances'] = $performances;
        $data['model_form'] = new Form;

        return view('/contents/forms/student-fill', $data); 
    }
}
