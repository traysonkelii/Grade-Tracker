<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Status</div>
        </div>
        @foreach ($recital as $rep)
            <div class="view-row">
                <div><p> {{$rep->name}} </p></div>
                <div> <p>{{$rep->composer->name}} </p></div>
                <div> <p>{{$rep->instrument->type}} </p></div>
                @if ($rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->recital) == 'Submitted')
                    @if($stat == "teacher")
                        <div class="teacher-approve"> 
                            <div class="word-approve">
                                <p> 
                                    {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->recital)}}
                                </p>
                            </div>
                                <div class="icon-holder">
                                    <img src="{{asset('images/approve.png')}}" class='accept' id='{{$rep->students->where('id',$student->id)->first()->pivot->rep_stu_id}}-recital-{{csrf_token()}}'>    
                                    <img src="{{asset('images/reject.png')}}" class='reject' id='{{$rep->students->where('id',$student->id)->first()->pivot->rep_stu_id}}-recital-{{csrf_token()}}'>
                                </div>
                        </div>
                    @else
                        <div> <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->recital)}} </p></div>
                    @endif
                @else
                    <div> <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->recital)}} </p></div>
                @endif
            </div>
        @endforeach
    </div>
</div>