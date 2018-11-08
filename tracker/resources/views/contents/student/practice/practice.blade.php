<div class="practice-holder">
    <div class="p-list">
        <p class="practice-header">Practice List</p>
        @foreach ($all as $rep)
            @if($rep->pivot->practice != 0)
                <p id="{{$rep->pivot->rep_stu_id}}-{{csrf_token()}}" class="practice-entry">{{$rep->name}}</p>
            @endif
        @endforeach
    </div>
    <div class="p-tot">
        Hours practiced
    </div>
    <div class="p-week non-use">
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
<div id="practice-popup"></div>

