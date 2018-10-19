
<div class="sort-repertoires">
    <div class="tab">
        <div id="all">All</div>
        <div id="juried">Juried</div>
        <div id="recital">Recital</div>
        <div id="unsubmitted">Unsubmitted</div>
    </div>
    <div id="all-rep">
        @include('contents.repertoire.list.all')
    </div>
    <div id="juried-rep">
        @include('contents.repertoire.list.juried')
    </div>
    <div id="recital-rep">
        @include('contents.repertoire.list.recital')
    </div>
    <div id="unsubmitted-rep">
        @include('contents.repertoire.list.unsubmitted')
    </div>
</div>
{{-- controls the tab and switches list displayed --}}
<script src="{{ asset('/js/repertoire/tabControl.js') }}"></script>
