@extends('layouts.app')

@section('content')

    <div class="sign-in-panel">
        <h1>Sign in</h1>
        <div>
            <form action="{{ route('getLanding')}}" method="post">
                @csrf
                <p> netid </p>
                <input type="text" name="netid" id="netid">
                <br><br><p>password</p>  
                <input type="password" name="password" id="password">
                <br><br>
                <input type="submit" value="submit">
            </form>
        </div>
    </div>

@endsection