<div class="practice-holder">
    <div class="p-list">
        @foreach ($all as $rep)
        <p>{{$rep->name}}    
        @endforeach
    </div>
    <div class="p-tot">
        Hours practiced
    </div>
    <div class="p-week non-use">
        <div class="swHolder">
            <div id="practice-record" class="swRecord sw-button">
                start
            </div>
            <div id="practice-reset" class="swReset sw-button">
                reset
            </div>
            <div id="practice-submit" class="swSubmit sw-button">
                submit
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

