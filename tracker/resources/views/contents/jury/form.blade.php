@extends('layouts.app')

@section('content')

    <div class="jury-form-holder">
        <h1>Form</h1>
        <p>{{$welcome}}</p>
        <div class="jury-form">
            <div>
                Title <input type="text">
            </div>
            <div class="jury-build-holder">
                <p id="form-token">{{csrf_token()}}</p>
                <p id="form-adder">Add Attribute</p>
                <p id="form-submit">Submit</p>
                <br>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/jury-form/juryFormAddAttribute.js') }}"></script>

@endsection