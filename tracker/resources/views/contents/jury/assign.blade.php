@extends('layouts.app')

@section('content')
<div>
    <h3>Students</h3>
    @foreach($students as $student)
    <p>{{$student->first_name}}</p>
    @endforeach
</div>
<div>
    <h3>Forms</h3>
    @foreach ($forms as $form)
        <p>{{$form->name}}</p>
    @endforeach
</div>
<div>
    <h3>Jury</h3>
    @foreach ($jury as $j)
        <p>{{$j->first_name}}</p>
    @endforeach
</div>

@endsection