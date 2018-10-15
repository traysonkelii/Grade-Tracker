<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Instrument Type</div>
            <div>Genre</div>
        </div>
            @foreach ($repertoires as $rep)
                <div class="view-row">
                    <div>{{$rep->name}}</div>
                    <div>{{$rep->composer->first_name}} {{$rep->composer->last_name}}</div>
                    <div>{{$rep->instrument->type}}</div>
                    <div>{{$rep->genre->name}}</div>
                </div>
        @endforeach
    </div>
</div>