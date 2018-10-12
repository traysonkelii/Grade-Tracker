
<div class="sort-repertoires">
    <div class="tab">
        {{-- <a href="{{route('all_rep')}}">
            <div id="all">All</div>
        </a>
        <a href="{{route('juried_rep')}}">
            <div id="juried">Juried</div>
        </a>
        <a href="{{route('recital_rep')}}">
            <div id="recital">Recital</div>
        </a>
        <a href="{{route('unassigned_rep')}}">
            <div id="practiced">Practiced</div>
        </a> --}}
    </div>
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
</div>
<script src="{{ asset('/js/rep-control.js') }}"></script>