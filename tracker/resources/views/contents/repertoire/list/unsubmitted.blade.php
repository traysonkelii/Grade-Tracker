<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Status</div>
        </div>
            @foreach ($repertoires as $rep)
            @if ($rep->students->where('id',$student->id)->first()->pivot->jury == 0)
            @if ($rep->students->where('id',$student->id)->first()->pivot->recital == 0)
                <div class="view-row">
                    <div>{{$rep->name}}</div>
                    <div>{{$rep->composer->first_name}} {{$rep->composer->last_name}}</div>
                    <div> {{$rep->instrument->type}}</div>
                    <div>Not Submitted</div>
                </div>
            @endif
            @endif
        @endforeach
    </div>
</div>