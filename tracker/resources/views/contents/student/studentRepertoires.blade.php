@extends('layouts.app')

@section('content')

<div class="sign-in-panel">
    <h1>{{$my_name}}'s Repertoires</h1>
            @foreach ($repertoires as $repertoire)
                <h3>{{$repertoire}}</h3>
            @endforeach
<a href="{{route('all_students')}}">Back to students</a>
</div>
        
@endsection