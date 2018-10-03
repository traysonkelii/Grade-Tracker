@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        <h1>Professor {{$teacher->first_name}}'s Pannel</h1>
        <br>
        <h2>Students</h2>
        @foreach($students as $student)
            <h3>{{$student->first_name}} {{$student->last_name}}</h3>
            <h3>netid: {{$student->id}}</h3>
            <a href="{{route('student_repertoire', ['student_id' => $student->id])}}">
                <h3>Repertoires</h3>
            </a>
            <br>
        @endforeach
    </div>

@endsection