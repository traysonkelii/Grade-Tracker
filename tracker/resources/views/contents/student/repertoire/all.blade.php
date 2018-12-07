<div class="list">
    <div class="viewed-list">
        <div class="view-row" id="control-row">
            <div>Title</div>
            <div>Composer</div>
            <div>Submit For Jury</div>
            <div>Submit For Recital</div>
        </div>
            @foreach ($all as $rep)
                <div class="view-row">
                    <div>
                        <p>{{$rep->name}} </p>
                    </div>
                    <div>
                        <p>
                            {{$rep->composer->name}}
                        </p>    
                    </div>
                    <div>
                        <p> {{$rep->assignStatus($rep->pivot->jury)}} </p>
                        @if (!$rep->pivot->jury)
                            <p>submit</p>
                        @endif
                    </div>
                    <div>
                        <p>{{$rep->assignStatus($rep->pivot->recital)}}</p>
                        @if (!$rep->pivot->recital)
                            <p>submit</p>
                        @endif  
                    </div>
                </div>
        @endforeach
    </div>
</div>