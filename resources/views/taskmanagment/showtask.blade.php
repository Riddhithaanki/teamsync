@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <h1>Add Project</h1>
@stop

@section('content')
<h3>Task Information</h3>
<form method="POST" action="{{ route('taskmanagment.viewtask')}}">
    @csrf
<div class="">
    <label>Select Project</label>
    <select name="project" id="project">
    @foreach($projects as $item)
    
        <option value="{{$item->id}}"> {{$item->project_name}} </option>
    
    @endforeach
    </select>
    <div>
    <label>Task of the Project</label>
    {{-- @foreach ($tasks as $list) 
    <table>
    <tr>{{$list->task_name}}</tr>
        
    @endforeach --}}
</div> 
<div>
    <input type="submit">
</div>
</form>

@endsection