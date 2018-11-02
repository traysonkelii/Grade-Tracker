@extends('layouts.app')

@section('content')

    <div class="panel">
        <h1>Professor {{$teacher->first_name}}'s Pannel</h1>
        <h2>Students</h2>
        @foreach($students as $student)
        <form id="{{$student->id}}" method="post" action="{{route('student', ['student_id' => $student->id])}}">
            @csrf    
            <input type="hidden" name="name" value="value" /> 
            <a onclick="document.getElementById('{{$student->id}}').submit();">
                <div class="teacher-attendance">
                    {{$student->first_name}} {{$student->last_name}}
                </div>
            </a>
        </form>
        @endforeach
    </div>

@endsection