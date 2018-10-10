@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">

    @if($stat == 'teacher')
    <h1>{{$student->first_name}} {{$student->last_name}}'s Pannel</h1>
        <div class="practice">

        </div>
        <div class="sort-repertoires">
            <div class="tab">
                <div id="all">All</div>
                <div id="juried">Juried</div>
                <div id="recital">Recital</div>
                <div id="practiced">Practiced</div>
            </div>
            <div class="list">
                <div class="viewed-list">
                    <div class="view-row" id="control-row">
                        <div>Title</div>
                        <div>Composer</div>
                        <div>Instrument Type</div>
                        <div>Genre</div>
                    </div>
                        @foreach ($repertoires as $rep)
                            <div class="view-row">
                                <div>{{$rep->name}}</div>
                                <div>{{$rep->composer->first_name}} {{$rep->composer->last_name}}</div>
                                <div>{{$rep->instrument->type}}</div>
                                <div>{{$rep->genre->name}}</div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script src="{{ asset('/js/rep-control.js') }}"></script>
    @elseif($stat == 'student')
        <p>I AM A {{$stat}}</p>
    @endif
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
        @endforeach
        </div>

@endsection