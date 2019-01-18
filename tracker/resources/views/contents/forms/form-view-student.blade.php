@extends('layouts.app')
@section('content')
<p id="formView-info">{{$form->attribute_array}}-{{$performance->student_response}}-{{csrf_token()}}-{{$student_id}}-{{$form->id}}</p>
<div style="text-align: center">
    <div class="formView-student">
        <h1>{{$form->name}}</h1>
    </div>
    <br>
    <h3>Student Responses</h3>
    <div id="formView-answers">
    </div>
    <br>
    <h3>Student Questions</h3>
    <div id="formView-holder">
    </div>
    <br>
    <span id="formView-submit">submit</span>
</div>
<script src="{{ asset('/js/form/juryStudentViewForm.js') }}"></script>
<script src="{{ asset('/js/form/juryFormStudentSave.js') }}"></script>
@endsection