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
        <h4>Current</h4> 
        @foreach ($performances as $p)
            @if ($model_form->checkActive($p->form_id))
                <a href="{{route('formViewStudent', ['form_id' => $p->form_id, 'student_id' => $student->id])}}">
                    <p>{{$model_form->getName($p->form_id)}}</p>
                </a>
            @endif
        @endforeach
        <h4>Past</h4>
        @foreach ($performances as $p)
            @if (!$model_form->checkActive($p->form_id))
                <a href="{{route('formViewStudent', ['form_id' => $p->form_id, 'student_id' => $student->id])}}">
                    <p>{{$model_form->getName($p->form_id)}}</p>
                </a>
            @endif
        @endforeach
    </div>
</div>
@endsection
