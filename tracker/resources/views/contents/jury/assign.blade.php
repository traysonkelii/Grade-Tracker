@extends('layouts.app')
@section('content')
<div class="assign-form-holder">
    <div class="assign-forms-holder">
        <h3>Forms</h3>
        <select>
            @foreach ($forms as $form)
                <option value="{{$form->id}}">{{$form->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="assign-student-holder">
        <h3>Students</h3>
        <div class="assign-header">
            <p>Name</p>
            <p>Netid</p>
            <p>Major</p>
            <p>Email</p>
        </div>
        @foreach($students as $student)
            <div class="assign-row-holder">
                <span><input type="checkbox" value="{{$student->id}}">
                {{$student->first_name}} {{$student->last_name}}</span>
                <p>{{$student->id}}</p>
                <p>{{$student->major->name}}</p>
                <p>{{$student->email}}</p>
            </div>
        @endforeach
    </div>
    <div class="assign-jury-holder">
        <h3>Jury</h3>
        <div class="assign-header">
                <p>Name</p>
                <p>Netid</p>
                <p>Department</p>
                <p>Email</p>
            </div>
        @foreach ($jury as $j)
        <div class="assign-row-holder">
                <span><input type="checkbox" value="{{$j->id}}">
                {{$j->first_name}} {{$j->last_name}}</span>
                <p>{{$j->id}}</p>
                <p>{{$j->departments->name}}</p>
                <p>{{$j->email}}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection