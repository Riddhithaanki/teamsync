@extends('adminlte::page')

@section('title', 'Assign User')

@section('content_header')
    <h1>Assign User to Project</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Project Assignment Form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('taskmanagment.assignuserview') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="project_name">Project Name</label>
                        <input type="text" class="form-control" value="{{ $project->project_name }}" disabled>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="assignuser">Select User to Assign</label>
                        <select name="assignuser" id="assignuser" class="form-control">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Assign User
                        </button>
                        {{-- <a href="{{ route('taskmanagment.projects') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Projects
                        </a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Optional: Add Select2 for better dropdown experience
            // $('#assignuser').select2();
            
            // Form validation
            $('form').submit(function(e) {
                if ($('#assignuser').val() === '') {
                    e.preventDefault();
                    alert('Please select a user to assign');
                }
            });
        });
    </script>
@stop