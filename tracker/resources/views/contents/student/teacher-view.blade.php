@extends('layouts.app')
@section('content')
<p id="token" style="display:none">{{ csrf_token() }}</p>
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
            @foreach ($practice as $p)
            <p>
                Repertorie id:{{$p->repertoire_id}}, Pivot id:{{$p->rep_stu_id}} Start:{{$p->practice_start}} Stop:{{$p->practice_stop}}
            </p>
            @endforeach
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
                            <p><span class="student-teacherView-removeFromPractice" id="{{$student->id}}-{{$rep->id}}-remove">X</span> {{ucfirst($rep->name)}}</p>
                            <p>{{ucfirst($rep->composer->name)}}</p>
                            <p>date</p>
                            <p>status</p>
                        </div>
                        <div class="student-teacherView-pdata">
                            <div class="student-teacherView-pdata-holder">
                                <div>
                                    <h5>Comments</h5>
                                    <div class="student-teacherView-comment-holder">
                                        <span id='comments-{{$rep->id}}'style="display:none">{{$comments = $model_comment->getAllComments($rep->pivot->rep_stu_id)}}</span>
                                        

                                        {{-- <div class="student-teacherView-tcomment">Hello</div>
                                        <div class="student-teacherView-scomment">Hey</div> --}}
                                    </div>
                                    <div class="student-teacherView-commentBox">
                                        <input type="text" placeholder="Comment" class="student-teacherView-message">
                                        <button class="student-teacherView-sendMessage">Send</button>
                                        <p style="display:none">{{$rep->pivot->rep_stu_id}}</p>
                                    </div>
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
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="student-teacherView-repertoire">
        <div class="student-teacherView-rtitle">
            <div class="student-teacherView-rtitle-header">Repertoire</div>
            <div class="student-teacherView-rsearch">
                <input type="text" placeholder=" Search... ">
            </div>
            <div class="student-teacherView-raddrep">
                <span class="student-teacherView-repbutton" id="add-rep">Add Repertoire</span>
            </div>
        </div>
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
                        <p class="student-teacherView-addToPractice" id="{{$student->id}}-{{$rep->id}}-add">Add to Practice</p>
                    @endif
                    <p>{{$rep->name}}</p>
                    <p>{{$rep->composer->name}}</p>
                    <p>date</p>
                    <p>jury:{{$rep->pivot->jury}} </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="{{ asset('/js/student/studentTeacherView.js') }}"></script>

<script src="{{ asset('/js/student/studentTeacherMessage.js') }}"></script>
@endsection