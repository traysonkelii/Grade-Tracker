@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        <h1>{{$firstName}}'s Pannel</h1>
        @foreach ($teachers as $teacher)
    <h3> Professor {{$teacher->first_name}} {{$teacher->last_name}}'s Class</h3>
            <p>assignments</p>
            <p>class</p>
        @endforeach
        <h4>My Major: {{$major}}</h4>
        <a href="{{route('student_repertoire', ['student_id' => $student_id])}}">
            <h4>My Repertoires</h4>
        </a>

    </div>

@endsection