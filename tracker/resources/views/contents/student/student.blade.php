@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        @if($stat == "teacher")
            <h1>(Teacher's view)</h1>
        @endif
        <h2>{{$student->first_name}} {{$student->last_name}}'s Pannel</h2>
        @include('contents.student.practice.practice')
        @include('contents.student.repertoire.repertoireHolder')
    </div>

@endsection