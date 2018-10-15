@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">

    @if($stat == 'teacher')
    <h1>{{$student->first_name}} {{$student->last_name}}'s Pannel</h1>
       
    @elseif($stat == 'student')
    <h1>Student</h1>
    @endif


    @include('contents.practice.practice')   
    @include('contents.repertoire.repertoire')
    {{-- 
        
        THESE ARE CONTROLS FOR THE STUDENT
        
        <h1>{{$student->first_name}} {{$student->last_name}}'s Pannel</h1>
    <h4><a href="{{route('rep_filter', ['student_id' => $student->id, 'type' => 'open'])}}">submit repertoires</a></h4>
    <h4><a href="{{route('rep_filter', ['student_id' => $student->id, 'type' => 'submitted'])}}">pending repertoires</a></h4>
    <h4><a href="{{route('rep_filter', ['student_id' => $student->id, 'type' => 'rejected'])}}">rejected repertoires</a></h4>
    <h4><a href="{{route('rep_filter', ['student_id' => $student->id, 'type' => 'accepted'])}}">accepted repertoires</a></h4>
    <h4>Major: {{$major->name}}</h4>
    <h2>Classes</h2>
        @foreach ($teachers as $teacher)
            <h3> 
                Professor {{$teacher->first_name}} {{$teacher->last_name}}'s Class
            </h3>
            <p>assignments</p>
            <p>class</p>
        @endforeach
    <h2>Repertoires</h2>
        @foreach ($repertoires as $rep)
            <h3> Title: {{$rep->name}}</h3>
            <h4> Composer: {{$rep->composer->first_name}} {{$rep->composer->last_name}}</h4>
            <h4> Instrument: {{$rep->instrument->type}}</h4>
            <h4> Genre: {{$rep->genre->name}}</h4>
        @endforeach --}}
        </div>

@endsection