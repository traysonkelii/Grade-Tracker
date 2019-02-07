@extends('layouts.app')
@section('content')
<div>
    <h1>THIS PAGE IS AN EXAMPLE OF USING COMPONENTS</h1>
    {{-- Test Component --}}
    @component('components.pannel')
        @slot('title')
            Large Title
        @endslot
        @slot('smaller')
            Small Title
        @endslot
        @slot('message')
            This is my message Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
            Doloremque ea, facilis quisquam praesentium non accusamus reprehenderit nam beatae rerum dolores a nemo, 
            quis aut commodi. Doloribus dolorem iste tempora culpa?
        @endslot
    @endcomponent
    <br>
    {{-- Search Component --}}
    @component('components.repertoire-search')
        @slot('size')
            50
        @endslot
    @endcomponent
</div>
@endsection