@extends('layouts.app')
@section('content')
@if($permissions == 1)
<h1>(Teacher's view)</h1>
@endif
    <div class="student-home-container">
        <div class="student-profile">
            <div class="student-img-holder">
                <img src="{{ asset('images/person.png') }}" alt="">
            </div>
            <h3>{{$student->first_name}} {{$student->last_name}}</h3>
            <h3>{{$student->email}}</h3>
            <h3>{{$student->major->name}}</h3>
        </div>
        <div class="student-repertoire">
            <h3>Repertoires</h3>
            <div class="student-repertoire-column-headers">
                    <p>Title</p>
                    <p>Composer</p>
                    <p>Instrument</p>
                    <p>Jury</p>
                    <p>Recital</p>
            </div>
            <div class="student-repertoire-list-holder">
                    @foreach ($all as $rep)
                <div class="student-repertoire-list-row">
                    <p>{{$rep->name}} </p>
                    <p>{{$rep->composer->name}}</p>
                    <p>{{$rep->instrument->name}}</p>
                    <p>
                        {{$rep->assignStatus($rep->pivot->jury)}}
                    </p>
                    <p>
                        {{$rep->assignStatus($rep->pivot->recital)}}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="student-practice student-bottom-panels">
            <div class="student-panel-headers">
                <h3>Practice</h3>
            </div>   
        </div>
        <div class="student-jury student-bottom-panels">
                <div class="student-panel-headers">
                    <h3>Recital</h3>
                </div>  
        </div>
        <div class="student-recital student-bottom-panels">
                <div class="student-panel-headers">
                    <h3>Repertoire</h3>
                </div>  
        </div>
    </div>
        <a href="{{route('practice', ['student_id' => $student->id])}}">Practice</a>

@endsection