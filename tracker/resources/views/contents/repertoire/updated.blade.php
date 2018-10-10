@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
    <h2>This Repertoire status has been updated</h2>
    <h3>Name: {{$repertoire->name}}</h3>
    <h3>Status: {{$status}}</h3>
    </div>

@endsection