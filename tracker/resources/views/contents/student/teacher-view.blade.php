@extends('layouts.app')
@section('content')
<div class="student-teacherView-holder">
    <div class="student-teacherView-top">
        <div class="student-teacherView-picture">
            <img src="{{ asset('images/person.png') }}" alt=""> 
            <span class="student-teacherView-name">{{strtoupper($student->first_name)}} {{strtoupper($student->last_name)}}</span>
        </div>
        <div class="student-teacherView-jury">
            <span class="student-teacherView-button">Approve Jury</span>
        </div>
    </div>
    <div class="student-teacherView-summary">
        <div class="student-teacherView-stitle">Summary</div>
        <div class="student-teacherView-sbody">
            <p>All Practice Data</p>
            {{$practice}}
        </div>
    </div>
    <div class="student-teacherView-practice">
        <div class="student-teacherView-ptitle">Practice</div>
        <div class="student-teacherView-pholder">
            <div class="student-teacherView-pheader">
                <p>NAME</p>
                <p>COMPOSER</p>
                <p>DATE</p>
                <p>STATUS</p>
            </div>
            @foreach ($reps as $rep)
                @if ($rep->pivot->practice)
                    <div class="student-teacherView-prow">
                        <div class="student-teacherView-pvalues">
                            <p>{{ucfirst($rep->name)}}</p>
                            <p>{{ucfirst($rep->composer->name)}}</p>
                            <p>date</p>
                            <p>status</p>
                        </div>
                        <div class="student-teacherView-pdata">
                                <p>Practice data for this Repertoire</p>
                                <div class="student-teacherView-pdata-holder">
                                    <div>
                                        <h5>Comments</h5>
                                    </div>
                                    <div>
                                        <h5>Practice Data</h5>
                                        @foreach ($practice as $p)
                                            @if ($p->repertoire_id == $rep->id)
                                                ID:{{$p->id}} Start:{{$p->practice_start}} Stop:{{$p->practice_stop}} <br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            {{-- COMMENT AND PRACTICE DISPLAY --- HIDDEN --}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="student-teacherView-repertoire">
        <div class="student-teacherView-rtitle">Repertoire</div>
        <div class="student-teacherView-rholder">
                <div class="student-teacherView-rheader">
                        <p></p>
                        <p>NAME</p>
                        <p>COMPOSER</p>
                        <p>DATE</p>
                        <p>STATUS</p>
                    </div>
            @foreach ($reps as $rep)
                <div class="student-teacherView-rvalues">
                    @if ($rep->pivot->practice)
                        <p>already added</p>
                    @else
                        <p>Add to Practice</p>
                    @endif
                    <p>{{$rep->name}}</p>
                    <p>{{$rep->composer->name}}</p>
                    <p>date</p>
                    <p>status</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection