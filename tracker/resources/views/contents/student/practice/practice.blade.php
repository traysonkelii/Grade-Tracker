<div class="practice-holder">
    <div class="p-list">
        <p class="practice-header">Repertoire List</p>
        @foreach ($all as $rep)
        <p id="p{{$rep->id}}" class="practice-entry">{{$rep->name}}<p>    
        @endforeach
    </div>
    <div class="p-tot">
        Hours practiced
    </div>
    <div class="p-week">
        <span id="practice-selected" class="hidden"></span>
        <div class="swHolder">
            <div id="practice-record" class="swRecord sw-button">
                start
            </div>
            <div id="practice-reset" class="swReset sw-button">
                reset
            </div>
            <div class="swDisplay">
                <span class="hours" id="stopwatch-hour">00</span>
                <span>:</span>
                <span class="minutes" id="stopwatch-min">00</span>
                <span>:</span>
                <span class="seconds" id="stopwatch-sec">00</span>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/practice/timer.js') }}"></script>
<script src="{{ asset('js/practice/repSelector.js') }}"></script>

