@extends('layouts.app')
@section('content')
    
<div>
    <h1>Test</h1>
    <p>Name: {{$student->first_name}}</p>
    <p>Major: {{$student->major->name}}</p>
    <div>
        <h3>
            Forms
        </h3> 
        @foreach ($forms as $form)
            <a href="{{route('formViewStudent', ['form_id' => $form->form_id, 'student_id' => $student->id])}}">
                <p>{{$model_form->getName($form->form_id)}}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
