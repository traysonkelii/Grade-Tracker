@extends('layouts.app')

@section('content')
<div class="sign-in-panel">
    <h1>All Students</h1>
            @foreach ($students as $student)
                <h3>Name: {{$student->first_name}} {{$student->last_name}}</h3>
                <h4>ID: {{$student->id}}</h4>
                <a href="{{route('student_repertoire', ['student_id' => $student->id])}}">
                    <h4>{{$student->first_name}}'s Repertoires</h4>
                </a>
                <br>
            @endforeach
</div>
        
@endsection