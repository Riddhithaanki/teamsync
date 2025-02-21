@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    <table class="table">
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Assigned To</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->user->name }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
