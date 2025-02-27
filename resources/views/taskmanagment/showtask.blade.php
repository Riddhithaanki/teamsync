@extends('adminlte::page')

@section('title', 'Task List')

@section('content_header')
    <h1>{{ $project->name ?? 'Project' }} - Task List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Tasks</h3>
                {{-- <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Task
                </a> --}}
            </div>
        </div>
        <div class="card-body">
            @if(count($tasks) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->task_id }}</td>
                                    <td>{{ $task->task_name }}</td>
                                    <td>{{ Str::limit($task->task_desc, 50) }}</td>
                                    <td>
                                        @if($task->task_status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($task->task_status == 1)
                                            <span class="badge badge-primary">In Progress</span>
                                        @elseif($task->task_status == 2)
                                            <span class="badge badge-success">Completed</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($task->task_priority == 0)
                                            <span class="badge badge-info">Low</span>
                                        @elseif($task->task_priority == 1)
                                            <span class="badge badge-warning">Medium</span>
                                        @elseif($task->task_priority == 2)
                                            <span class="badge badge-danger">High</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($task->task_due_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group m-2">
                                           
                                            <a href="{{route('taskmanagment.edittask', \Crypt::encrypt($task->task_id))}}" class="btn btn-warning btn-sm m-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('taskmanagment.deletetask', \Crypt::encrypt($task->task_id)) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure you want to delete this task?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No tasks found for this project.
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{-- <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a> --}}
        </div>
    </div>
@stop

@section('css')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Initialize DataTable if you want sorting/searching functionality
        $('.table').DataTable();
    });
</script>
@stop
