<div class="list">
        <div class="viewed-list">
            <div class="view-row" id="control-row">
                <div>Title</div>
                <div>Composer</div>
                <div>Instrument Type</div>
                <div>Status</div>
            </div>
                @foreach ($repertoires as $rep)
                    @if ($rep->students->where('id',$student->id)->first()->pivot->jury != 0)
                    <div class="view-row">
                        <div><p> {{$rep->name}} </p></div>
                        <div> <p>{{$rep->composer->first_name}} {{$rep->composer->last_name}} </p></div>
                        <div> <p>{{$rep->instrument->type}} </p></div>
                        @if ($stat == 'teacher')
                            @if ($rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury) == 'Submitted')
                                <div class="teacher-approve"> 
                                    <div class="word-approve">
                                            <p> 
                                                    {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}}
                                            </p>
                                    </div>
                                    <div class="icon-holder">
                                    <img src="{{asset('images/approve.png')}}" rep="{{$rep->id}}" class='accept' name='{{$student->id}}' type='jury'>    
                                            <img src="{{asset('images/reject.png')}}" rep="{{$rep->id}}" class='reject' name='{{$student->id}}' type='jury'>
                                    </div>
                                </div>
                            @else
                                <div> <p> {{$rep->assignStatus($rep->students->where('id',$student->id)->first()->pivot->jury)}} </p></div>
                            @endif
                        @else
                        <div> <p> IM JUSTA STUDENT</p></div>
                        @endif
                    </div>
                    @endif
            @endforeach
        </div>
    </div>
    <script src="{{ asset('/js/repertoire/updateStatus.js') }}"></script>
    <script src="{{ asset('/js/repertoire/approveReject.js') }}"></script>
