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
                    <div> 
                        <p>{{$rep->name}} </p>
                    </div>
                    <div>
                        <p>
                            {{$rep->composer->first_name}} {{$rep->composer->last_name}}
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