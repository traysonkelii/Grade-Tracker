@extends('layouts.app')

@section('content')
{{-- 0 = composer
1 = genre
2 = instrument
3 = repertoire --}}
<div class="sign-in-panel">
        <h1>{{$student->first_name}}'s Repertoires</h1>
    @if (! empty($piece))
            @foreach ($piece as $details)
                <h3>Title: {{$details[3]->name}}</h3>
                <h4>Composer: {{$details[0]->first_name}} {{$details[0]->last_name}}</h4>
                <h4>Instrument: {{$details[2]->type}}</h4>
                <h4>Genre: {{$details[1]->name}}</h4>
            @endforeach
    @else 
        <h3>None</h3>
    @endif
    <a href="{{route('all_students')}}">
        Back to students
    </a>
</div>
        
@endsection