@extends('layouts.app')
@section('content')

<div class="teacher-landing-holder">

    <div class="teacher-landing-top teacher-landing-pannels">
        <h1>Professor {{ucfirst($teacher->first_name)}}'s Students</h1>
        <a href="{{route('teacherGoToJury', ['teacher_id' => $teacher->id])}}" style="text-decoration:none">
            <span id="teacher-landing-jury-mode" name="{{$teacher->id}}">Jury Mode</span>
        </a>
    </div>

    <div class="teacher-landing-list teacher-landing-pannels">
        <div class="teacher-landing-student-header">
            <p>Name</p>
            <p>Grad Date</p>
            <p>Department</p>
            <p>Instrument</p>
        </div>
        @foreach($students as $student)
            <form id="{{$student->id}}" class="student-holder" method="post" action="{{route('practice', ['student_id' => $student->id])}}">
               
                @csrf    
                <input type="hidden" name="permissions" value="{{$permissions}}" /> 
                <div class="teacher-landing-student-row" onclick="document.getElementById('{{$student->id}}').submit();">
                    <p>{{ucfirst($student->first_name)}} {{ucfirst($student->last_name)}} </p>
                    <p>April 2019</p>
                    <p>Test</p>
                </div>
                <div class="teacher-landing-student-courses">
                    @foreach ($student->courses as $course)
                        <p>{{$course->name}}</p>
                    @endforeach
                </div>
            </form>
        @endforeach
    </div>
    <div class="teacher-landing-alert teacher-landing-pannels">
        <div class="teacher-landing-alert-header">
            <h3>Alerts</h3>
        </div>
        <div class="teacher-landing-left-body">
            <div class="teacher-landing-row">
                <p>Fake Alarm 1</p>
            </div>
            <div class="teacher-landing-row">
                <p>Fake Alarm 2</p>
            </div>
        </div>
    </div>

    <div class="teacher-landing-course teacher-landing-pannels">
        <div class="teacher-landing-left-header">
            <h3>Courses</h3>
        </div>
        <div class="teacher-landing-left-body">
            <div class="teacher-landing-row">
                <p id="teacher-show-all">All Students</p>
            </div>
            <div id="teacher-course-holder">
                @foreach ($courses as $course)
                <div class="teacher-landing-row">
                    <p id="{{$course->name}}">{{str_replace('_',' ',$course->name)}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="teacher-landing-quick teacher-landing-pannels">
        <div class="teacher-landing-left-header">
            <h3>Quick List</h3>
        </div>
        <div class="teacher-landing-left-body">
            <div class="teacher-landing-row">
                    <p>Fake QL 1</p>
                </div>
                <div class="teacher-landing-row">
                    <p>Fake QL 2</p>
            </div>
        </div>
    </div>

</div>

    <script src="{{ asset('/js/teacher/teacherCourseFilter.js') }}"></script>
@endsection