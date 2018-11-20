@extends('layouts.app')
@section('content')
<div class="practice-holder">
    <div class="practice-list">
        <p class="practice-header">Practice List</p>
        @foreach ($all as $rep)
            @if($rep->pivot->practice != 0)
                <p id="{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}" class="practice-entry">{{$rep->name}} - {{$rep->instrument->name}} - {{$rep->composer->name}} - {{$rep->genre->name}}</p>
                <p class="practice-removeFromList" id="remove-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}">Remove from practice</p>
               {{-- remove from practice --}}
            @endif
        @endforeach
    </div>
    <div class="practice-graph">
        GRAPH INFO
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
        <p class="practice-header">All My Repertoires</p>
        @foreach ($all as $rep)
            <p class="practice-all">{{$rep->name}} - {{$rep->instrument->name}} - {{$rep->composer->name}} - {{$rep->genre->name}}</p>
            @if($rep->pivot->practice == 0)
                <p class="practice-addToList" id="add-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}">Add to practice</p>
                <p class="practice-safeRemove" id="remove-{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}">Remove from list</p>
            @endif
        @endforeach
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
<div id="practice-loading-popup"><img src="{{ asset('images/loading1.gif') }}" alt=""></div>
{{-- this needs to be loaded on the view to leverage Laravel route  --}}
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
<script src="{{ asset('/js/practice/practiceTracker.js') }}"></script>
<script src="{{ asset('/js/practice/practiceListEdit.js') }}"></script>
<script src="{{ asset('/js/practice/practiceRepSubmit.js') }}"></script>

@endsection