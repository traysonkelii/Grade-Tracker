@extends('layouts.app')
@section('content')

    <div class="jury-form-holder">
        <h1>Form</h1>
        <p>{{$welcome}}</p>
        <div class="jury-form">
            <div>
                Title <input type="text" id="form-name">
            </div>
            <div class="jury-build-holder">
                <p id="form-token">{{csrf_token()}}</p>
                <p id="form-adder">Add Attribute</p>
                <p id="form-submit">Submit</p>
                <br>
            </div>
        </div>
    </div>
    <div>
    <h3>Forms</h3>
        <p>Automated forms will be available here</p>
        <div>
            @foreach($forms as $form)
            <a href="{{route('formView', ['form_id' => $form->id])}}">
                <h4>{{$form->name}}</h4>
            </a>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('/js/jury-form/juryFormAddAttribute.js') }}"></script>

@endsection