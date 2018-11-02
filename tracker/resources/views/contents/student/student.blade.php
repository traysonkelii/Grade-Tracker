@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">

        @if($stat == 'teacher')

            <h1>Student Home Page (Teacher's view)</h1>
            <h2>{{$student->first_name}} {{$student->last_name}}'s Pannel</h2>
            @include('contents.student.practice.practice')
            @include('contents.student.repertoire.teacherRepertoireView')
       
        @elseif($stat == 'student')
            
            <h1>Student Home Page</h1>
            @include('contents.student.practice.practice')
            @include('contents.student.repertoire.studentRepertoireView')
               
        @endif
    </div>

@endsection