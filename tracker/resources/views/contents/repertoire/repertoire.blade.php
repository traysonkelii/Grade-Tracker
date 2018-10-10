@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
    <h2>{{$student->first_name}}'s Current Repertoires</h2>
        @foreach ($student->repertoires as $rep)
            <h3> Title: {{$rep->name}}</h3>
            <h4> Composer: {{$rep->composer->first_name}} {{$rep->composer->last_name}}</h4>
            <h4> Instrument: {{$rep->instrument->type}}</h4>
            <h4> Genre: {{$rep->genre->name}}</h4>
            <h4>Status: {{$rep->pivot->status}}</h4>
            @if($rep->pivot->status == "open")
    <a href="{{route('rep_submit', ['student_id' => $student->id, 'repertoire_id' => $rep->id])}}">Submit</a>
            @else
                <p>Already Submitted</p>
            @endif
        @endforeach
        </div>

@endsection