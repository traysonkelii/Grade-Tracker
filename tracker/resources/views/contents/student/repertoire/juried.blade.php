<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Status</div>
        </div>
        @foreach ($jury as $rep)
            <div class="view-row">
                <div><p> {{$rep->name}} </p></div>
                <div><p>{{$rep->composer->name}}</p></div>
                <div><p>{{$rep->instrument->name}} </p></div>
                @if ($rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury) == 'Submitted')
                    <div class="teacher-approve"> 
                        <div class="word-approve">
                            <p> 
                                {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}}
                            </p>
                        </div>
                        <div class="icon-holder">
                            <img src="{{asset('images/approve.png')}}" class='accept' id='{{$rep->students->where('id',$student->id)->first()->pivot->rep_stu_id}}-jury-{{csrf_token()}}'>    
                            <img src="{{asset('images/reject.png')}}" class='reject' id='{{$rep->students->where('id',$student->id)->first()->pivot->rep_stu_id}}-jury-{{csrf_token()}}'>
                        </div>
                    </div>
                        <div> <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}} </p></div>
                @else
                    <div> <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}} </p></div>
                @endif
            </div>
        @endforeach
    </div>
</div>

