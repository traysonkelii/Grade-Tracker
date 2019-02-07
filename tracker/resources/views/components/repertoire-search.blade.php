<div class="component-repertoire-search">
    <p>*search component</p>
    search: <input type="text" id="component-input-repertoire" size="{{$size}}">
    <p>Selected Repertoire: <span id="component-selected-repertoire"></span></p>
</div>
<br>

<script type="text/javascript">
const repPath = "{{ route('repAuto') }}";
     $('#component-input-repertoire').typeahead({
        source:  function (query, process) {
        return $.get(repPath, { query: query }, function (data) {
                return process(data);
            });
        },
        updater: function (selected) {
            $('#component-selected-repertoire').append(selected)
            return selected
        }
    });
</script>