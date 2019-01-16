@extends('layouts.app')
@section('content')

<div class="teacher-landing-holder">

    <div class="teacher-landing-top">
        <div class="top-title">
            <h4>STUDENTS</h4>
        </div>
        <div class="top-functions">
            <div>
                <input type="text" placeholder=" Search students...">
                <a href="{{route('teacherGoToJury', ['teacher_id' => $teacher->id])}}" style="text-decoration:none">
                    <span id="teacher-landing-jury-mode" name="{{$teacher->id}}">Jury Mode</span>
                </a>   
            </div>
        </div>
    </div>

    <div class="teacher-landing-list teacher-landing-pannels">
        <div class="teacher-landing-student-header student-headers">
            <p>NAME</p>
            <p>DEPARTMENT/INSTRUMENT</p>
            <p>GRADUATION DATE</p>
            <p>STATUS</p>
        </div>
        @foreach($students as $student)
            <form id="{{$student->id}}" class="student-holder" method="post" action="{{route('practice', ['student_id' => $student->id])}}">
               
                @csrf    
                <input type="hidden" name="permissions" value="{{$permissions}}" /> 
                <div class="teacher-landing-student-row" onclick="document.getElementById('{{$student->id}}').submit();">
                    <p class="student">{{ucfirst($student->first_name)}} {{ucfirst($student->last_name)}} </p>
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
            <h4>Alerts</h4>
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
            <h4>Courses</h4>
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

</div>

    <script src="{{ asset('/js/teacher/teacherCourseFilter.js') }}"></script>
@endsection