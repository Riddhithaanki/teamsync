@extends('adminlte::page')

@section('title', 'Edit Project')

@section('content_header')
    <h1>Edit Project</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Project Information</h3>
            </div>

            <form action="{{ route('taskmanagment.updateData') }}" method="POST">
                @csrf
                <input type="text" name="id" id="id" value="{{ $project->id }}" hidden>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Project Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter Project name" value="{{ $project->project_name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc">Project Description</label>
                                <input type="text" name="desc" class="form-control "
                                    id="desc" placeholder="Enter Project Description" value="{{ $project->project_desc }}" required>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tech">Project Technoloy</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                     
                                    </div>
                                    <input type="text" name="tech" class="form-control"
                                        id="tech" placeholder="Enter Project Technology" value="{{ $project->project_tech }}" required>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            
                            <label for="date">Select Start Date:</label>
                            <input type="datetime" id="sdate" name="sdate" value="{{ $project->project_start_date }}" class="form-control">    
                                   
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            
                            <label for="date">Select End Date:</label>
                            <input type="datetime" id="edate" name="edate" value="{{ $project->project_end_date }}" class="form-control">    
                                   
                            </div>
                        </div>
                    </div>

                    

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Project
                    </button>
                    <a href="{{ route('taskmanagment.index') }}" class="btn btn-default float-right">
                        <i class="fas fa-times-circle mr-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    $(function () {
        //Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        //Initialize Date picker
        $('#joining_date_picker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'fas fa-times'
            }
        });
    });
</script>
@stop
