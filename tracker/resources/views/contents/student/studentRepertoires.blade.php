@extends('layouts.app')

@section('content')
<div class="sign-in-panel">
        <h1>{{$student->first_name}}'s Repertoires</h1>
            @foreach ($repertoires as $rep)
                <h3>Title: {{$rep->name}}</h3>
                <h4>Composer: {{$rep->composer->first_name}} {{$rep->composer->last_name}}</h4>
                <h4>Instrument: {{$rep->instrument->type}}</h4>
                <h4>Genre: {{$rep->genre->name}}</h4>
            @endforeach
    <a href="{{route('all_students')}}">
        Back to students
    </a>
</div>
        
@endsection