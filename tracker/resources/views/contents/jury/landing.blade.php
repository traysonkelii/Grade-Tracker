@extends('layouts.app')
@section('content')
<div class="jury-landing-container">
    <div class="jury-landing-top jury-landing-pannels">
        <h1>Professor {{ucfirst($teacher->last_name)}}'s Jury Page</h1>
    </div>
    <div class="jury-landing-left">
        <div class="jury-landing-left-header">
            <h3>
                {{ucfirst($teacher->departments->name)}}
            </h3>
        </div>
        <div class="jury-landing-left-body">
            <div id="jury-landing-all">
               <p>All</p>
            </div>
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
            <form id="{{$student->id}}" class="student-holder" method="post" action="{{route('juryGradeStudent', ['student_id' => $student->id])}}">
                @csrf    
                <input type="hidden" name="permissions" value="{{$teacher->permissions}}" /> 
                <div class="jury-landing-student-row" onclick="document.getElementById('{{$student->id}}').submit();">
                    <p>{{ucfirst($student->first_name)}} {{ucfirst($student->last_name)}}</p>        
                    <p>April 2019</p>
                    @foreach ($student->teachers as $my_teacher)
                        @if ($my_teacher->id == $teacher->id )
                            <p>{{$model_dep->getDepartmentName($my_teacher->pivot->department_id)}}</p>
                            <p>{{$model_ins->getInstrumentName($my_teacher->pivot->instrument_id)}}</p>
                        @endif
                    @endforeach
                </div>
            </form>
        @endforeach
    </div>
</div>
<script src="{{ asset('/js/jury/juryInstrumentFilter.js') }}"></script>

@endsection