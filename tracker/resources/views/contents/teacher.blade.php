@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        <h1>Teacher Pannel</h1>
        <a href="{{ route('all_students')}}">View All students</a>
    </div>

@endsection