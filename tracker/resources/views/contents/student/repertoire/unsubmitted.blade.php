<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Status</div>
        </div>
        @foreach ($unsubmitted as $rep)
        <div class="view-row">
            <div><p> {{$rep->name}} </p></div>
            <div> <p>{{$rep->composer->name}} </p></div>
            <div> <p>{{$rep->instrument->name}} </p></div>
            @if ($rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury) == 'Submitted')
                @if ($status)
                    <div class="teacher-approve"> 
                        <div class="word-approve">
                            <p> 
                                {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}}
                            </p>
                        </div>
                        <div class="icon-holder">
                            <img src="{{asset('images/approve.png')}}" class='accept' name='{{$student->id}} jury {{$rep->id}} {{csrf_token()}}'>    
                            <img src="{{asset('images/reject.png')}}" class='reject' name='{{$student->id}} jury {{$rep->id}} {{csrf_token()}}'>
                        </div>
                    </div>
                @endif
            @else
                <div> 
                    <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}} </p>
                    @if (!$permissions)
                        <p>
                            <span>Jury</span>
                            <span>Recital</span>
                        </p>
                    @endif
                </div>
            @endif
        </div>
@endforeach
    </div>
</div>