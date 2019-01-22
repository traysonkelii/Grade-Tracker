@extends('layouts.app')
@section('content')
<div class="student-teacherView-holder">
    <div class="student-teacherView-top">
        <div class="student-teacherView-picture">
            <img src="{{ asset('images/person.png') }}" alt=""> 
            <span class="student-teacherView-name">{{strtoupper($student->first_name)}} {{strtoupper($student->last_name)}}</span>
        </div>
        <div class="student-teacherView-jury">
            <span class="student-teacherView-button">Approve Jury</div>
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
            <div class="student-teacherView-pbody">
                @foreach ($reps as $rep)
                    <div class="student-teacherView-prow">
                        <div class="student-teacherView-pvalues">
                            <p>{{ucfirst($rep->name)}}</p>
                            <p>{{ucfirst($rep->composer->name)}}</p>
                            <p>date</p>
                            <p>approved</p>
                        </div>
                        <div class="student-teacherView-pdata">
                            {{-- COMMENT AND PRACTICE DISPLAY --- HIDDEN --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="student-teacherView-repertoire">
        <div class="student-teacherView-rtitle">Repertoire</div>
        <div class="student-teacherView-rholder">Holder</div>
    </div>
</div>
@endsection