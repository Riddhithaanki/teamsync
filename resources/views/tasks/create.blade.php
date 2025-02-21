@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Task</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Assign To</label>
            <select name="assigned_to" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create Task</button>
    </form>
</div>
@endsection
