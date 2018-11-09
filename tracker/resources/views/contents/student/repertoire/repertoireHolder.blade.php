<div class="sort-repertoires">
    <div class="tab">
        <div id="all">All</div>
        <div id="juried">Juried</div>
        <div id="recital">Recital</div>
        <div id="unsubmitted">Unsubmitted</div>
    </div>
    <div id="all-rep">
        @include('contents.student.repertoire.all')
    </div>
    <div id="juried-rep">
        @include('contents.student.repertoire.juried')
    </div>
    <div id="recital-rep">
        @include('contents.student.repertoire.recital')
    </div>
    <div id="unsubmitted-rep">
        @include('contents.student.repertoire.unsubmitted')
    </div>
</div>
<script src="{{ asset('/js/repertoire/tabControl.js') }}"></script>
<script src="{{ asset('/js/practice/practiceTracker.js') }}"></script>
<script src="{{ asset('/js/practice/addToPractice.js') }}"></script>
<script src="{{ asset('/js/repertoire/ajaxUpdateStatus.js') }}"></script>
<script src="{{ asset('/js/repertoire/approveReject.js') }}"></script>