@extends('layouts.app')
@section('content')
<div>
    <h3>Test</h3>
    @component('components.list')
        @slot('title')
            My Title
        @endslot
        @slot('smaller')
            Smaller Title
        @endslot
        @slot('message')
            This is my message
        @endslot
    @endcomponent
</div>
@endsection