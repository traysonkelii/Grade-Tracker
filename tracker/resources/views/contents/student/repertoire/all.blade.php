<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Genre</div>
        </div>
            @foreach ($all as $rep)
                <div class="view-row">
                    <div>
                        @if($stat == 'student') 
                            @if($rep->pivot->practice == '0')
                                <p id="all-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}" class="add-practice">Add to practice</p>
                            @endif
                        @endif
                        <p>{{$rep->name}} </p>
                    </div>
                    <div>
                        <p>
                            {{$rep->composer->name}}
                        </p>    
                    </div>
                    <div>
                        <p>{{$rep->instrument->type}}</p>
                    </div>
                    <div>
                        <p>{{$rep->genre->name}}</p>
                    </div>
                </div>
        @endforeach
    </div>
</div>