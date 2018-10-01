@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        <h1>{{$firstName}}'s Pannel</h1>
        <h3>My Teacher: {{$teacher}}</h3>
        <h4>Major: {{$major}}</h4>
        <a href="{{route('student_repertoire', ['student_id' => $student_id])}}">
            <h4>My Repertoires</h4>
        </a>

    </div>

@endsection