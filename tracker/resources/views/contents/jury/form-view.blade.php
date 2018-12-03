@extends('layouts.app')

@section('content')
<p id="formView-info">{{$form->attribute_array}}-{{csrf_token()}}</p>
<div class="formView-container">
    <div class="formView-student">
        <h1>{{$form->name}} Jury Form</h1>
        <h3>Student Name</h3>
    </div>
    <div class="formView-piece">
            <div class="form-piece-holder">
                <div class="form-piece">
                    <h3>Example Piece 1</h3>
                </div>
                <div class="form-piece">
                    <h3>Example Piece 2</h3>
                </div>
            </div>
    </div>
    <div class="formView-whole">
        <h3>Overall Performance</h3>
        <div class="form-whole">
        </div>
    </div>
</div>
<script src="{{ asset('/js/jury-form/juryViewForm.js') }}"></script>


@endsection