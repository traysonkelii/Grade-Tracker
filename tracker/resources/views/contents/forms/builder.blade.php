@extends('layouts.app')
@section('content')
    
<div>
    <h1>Form Builder</h1>
    <p>Select a department</p>
    <select name="" id="department">
        @foreach ($department as $d)
            <option value="{{$d->id}}-{{$d->name}}">{{$d->name}}</option>
        @endforeach
    </select>
    <br>
    <br>
    <span style="display:none" id="form-token">{{csrf_token()}}</span>
    <p id="form-adder">+</p>
    <p id="form-name"></p>
    <div class="jury-build-holder"></div>
    <br>
    <p id="form-submit">Submit</p>
</div>
<script src="{{ asset('/js/form/juryFormBuilder.js') }}"></script>
@endsection
