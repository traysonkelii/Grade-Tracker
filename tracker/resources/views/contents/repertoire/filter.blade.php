@extends('layouts.app')

@section('content')

    
        <div class="sign-in-panel">
        <h2>{{$student->first_name}}'s Repertoires</h2>
            @foreach ($repertoires as $rep)
            <h2>{{$rep->name}}</h2>
            @if($type == 'open')
                <a href="{{route('rep_submit', ['student_id' => $student->id, 'repertoire_id' => $rep->id])}}">Submit</a>
            @endif
            @endforeach
        </div>
@endsection