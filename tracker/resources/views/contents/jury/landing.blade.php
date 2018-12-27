@extends('layouts.app')
@section('content')
<div class="jury-landing-container">
    <div class="jury-landing-top jury-landing-pannels">
        <h1>Professor {{ucfirst($teacher->last_name)}}'s Jury Page</h1>
        {{-- <a href="{{route('teacherGoToJury', ['teacher_id' => $teacher->id])}}" style="text-decoration:none">
            <span id="teacher-landing-jury-mode" name="{{$teacher->id}}">Jury Mode</span>
        </a> --}}
    </div>
    <div class="jury-landing-left">
        <div class="jury-landing-left-header">
            <h3>
                {{ucfirst($teacher->departments->name)}}
            </h3>
        </div>
        <div class="jury-landing-left-body">
            @foreach ($instruments as $instrument)
                <div class="jury-landing-row">
                    <p>{{$instrument->name}}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="jury-landing-right">
            <div class="jury-landing-student-header">
                    <p>Name</p>
                    <p>Grad Date</p>
                    <p>Department</p>
                    <p>Instrument</p>
                    <p>Status</p>
                </div>
                @foreach($students as $student)
                    <form id="{{$student->id}}" class="student-holder" method="post" action="{{route('practice', ['student_id' => $student->id])}}">
                       
                        @csrf    
                        <input type="hidden" name="permissions" value="{{$teacher->permissions}}" /> 
                        <div class="jury-landing-student-row" onclick="document.getElementById('{{$student->id}}').submit();">
                            <p>{{ucfirst($student->first_name)}} {{ucfirst($student->last_name)}}</p>        
                            <p>April 2019</p>
                        </div>
                    </form>
                @endforeach
    </div>
</div>
@endsection