@extends('layouts.app')
@section('content')
<div class="practice-holder">
    <div class="practice-list">
        <h3>Practice List</h3>
        <div class="repertoire-column-headers">
                <p>Title</p>
                <p>Composer</p>
                <p>Jury</p>
                <p>Recital</p>
                <p>Remove</p>
        </div>
        <div class="repertoire-list-holder">
            @foreach ($all as $rep)
                @if($rep->pivot->practice != 0)
                    <div class="repertoire-list-row">
                        <p id="{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}" class="practice-entry">{{$rep->name}} </p>
                        <p>{{$rep->composer->name}}</p>
                        <p>{{$rep->assignStatus($rep->pivot->jury)}}</p>
                        <p>{{$rep->assignStatus($rep->pivot->recital)}}</p>
                        <span><img src="{{asset('images/reject.png')}}" alt="" class="practice-removeFromList" id="remove-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}"></span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="practice-graph">
        <h3>Practice Data</h3>
        <p>Status: {{$permissions}}</p>    
    </div>
    <div class="practice-tracker practice-nonUse">
        <span id="practice-selected" class="hidden"></span>
        <div class="practice-stopWatchHolder">
            <div id="practice-record" class="practice-stopWatchRecord practice-button">
                start
            </div>
            <div id="practice-reset" class="practice-stopWatchReset practice-button">
                reset
            </div>
            <div class="practice-stopWatchDisplay">
                <span class="hours" id="stopwatch-hour">00</span>
                <span>:</span>
                <span class="minutes" id="stopwatch-min">00</span>
                <span>:</span>
                <span class="seconds" id="stopwatch-sec">00</span>
            </div>
        </div>
    </div>
    <div class="practice-allRepHolder">
            <h3>Repertoire List</h3>
            <div class="repertoire-column-headers">
                    <p>Title</p>
                    <p>Composer</p>
                    <p>Jury</p>
                    <p>Recital</p>
                    <p>Add</p>
            </div>
            <div class="repertoire-list-holder">
                @foreach ($all as $rep)
                    <div class="repertoire-list-row">
                        <img src="{{asset('images/red.png')}}" alt="" class="permanent-remove practice-safeRemove" id="delete-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}">
                        <p>{{$rep->name}} </p>
                        <p>{{$rep->composer->name}}</p>
                        <p>{{$rep->assignStatus($rep->pivot->jury)}}</p>
                        <p>{{$rep->assignStatus($rep->pivot->recital)}}</p>
                        @if ($rep->pivot->practice == 0)
                            <span><img src="{{asset('images/approve.png')}}" alt="" class="practice-addToList" id="add-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}"></span>
                        @else 
                            <p>Already Added</p>
                        @endif
                    </div>
                @endforeach
            </div>
    </div>
    <div class="practice-addRep">
        <p>Add a Repertoire</p>
        <p>Repertoire</p>
        <input class="typeahead form-control" id="practice-repertoireInput" type="text">
        <p>Composer</p>
        <input class="typeahead form-control" id="practice-composerInput" type="text">
        <p>Instrument</p>
        <input class="typeahead form-control" id="practice-instrumentInput" type="text">
        <p>Genre</p>
        <input class="typeahead form-control" id="practice-genreInput" type="text">
        <p class="practice-hidden" id="my-stu-id">{{$student->id}}</p>
        <button class="btn btn-dark" id="practice-submitRep" name="{{csrf_token()}}">submit</button>
    </div>
</div>

<div id="practice-popup"></div>
<div id="practice-loading-popup"><img src="{{ asset('images/loser-load.gif') }}" alt=""></div>

<div id="practice-removeModal" class="practice-safeRemoveModal">
    <div class="practice-safeRemoveContent">
        <div class="practice-safeContent">
            <h1>YOU ARE ABOUT TO DELETE THIS REPERTOIRE AND ALL MUSIC
                ATTRIBUTES TIED TO IT. PLEASE SELECT YES TO CONTINUE OR NO
                TO CANCEL
            </h1>
        </div>
        <div class="practice-safeYes">
            <div id="practice-confirmYes" class="modal-button">YES</div>
        </div>
        <div class="practice-safeNo">
            <div id="practice-confirmNo" class="modal-button">NO</div>
        </div>
    </div> 
</div>

{{-- this needs to be loaded on the view to leverage Laravel route  --}}
<script src="{{ asset('/js/practice/practiceTracker.js') }}"></script>
<script type="text/javascript">

    const comPath = "{{ route('comAuto') }}";
    const genPath = "{{ route('genAuto') }}";
    const repPath = "{{ route('repAuto') }}";
    const insPath = "{{ route('insAuto') }}";

    $('#practice-repertoireInput').typeahead({
        source:  function (query, process) {
        return $.get(repPath, { query: query }, function (data) {
                return process(data);
            });
        },
        updater: function (selected) {
            const stringArray = selected.split("|");
            const rep = stringArray[0].trim();
            $('#practice-composerInput').val(stringArray[1].trim())
            $('#practice-instrumentInput').val(stringArray[2].trim())
            $('#practice-genreInput').val(stringArray[3].trim());
            return rep;
        }
    });

    $('#practice-composerInput').typeahead({
    source:  function (query, process) {
    return $.get(comPath, { query: query }, function (data) {
            return process(data);
        });
    }
    });

    $('#practice-genreInput').typeahead({
        source:  function (query, process) {
        return $.get(genPath, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    $('#practice-instrumentInput').typeahead({
        source:  function (query, process) {
        return $.get(insPath, { query: query }, function (data) {
                return process(data);
            });
        }
    });
    
</script>
<script src="{{ asset('/js/practice/practiceListEdit.js') }}"></script>
<script src="{{ asset('/js/practice/practiceRepSubmit.js') }}"></script>

@endsection