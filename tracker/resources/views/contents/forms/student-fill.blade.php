@extends('layouts.app')
@section('content')
    
<div>
    <h1>Test</h1>
    <p>Name: {{$student->first_name}}</p>
    <p>Major: {{$student->major->name}}</p>
    <p>form id: {{$student->form_id}}</p>
</div>
{{-- <script src="{{ asset('/js/practice/practiceListEdit.js') }}"></script>
<script src="{{ asset('/js/practice/practiceRepSubmit.js') }}"></script> --}}

@endsection
