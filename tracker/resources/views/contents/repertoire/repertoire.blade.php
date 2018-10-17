
<div class="sort-repertoires">
    <div class="tab">
        <a href="#">
            <div id="all">All</div>
        </a>
        <a href="#">
            <div id="juried">Juried</div>
        </a>
        <a href="#">
            <div id="recital">Recital</div>
        </a>
        <a href="#">
            <div id="unsubmitted">Unsubmitted</div>
        </a>
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
<script src="{{ asset('/js/repertoire/tabControl.js') }}"></script>
