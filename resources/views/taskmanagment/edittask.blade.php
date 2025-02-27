@extends('adminlte::page')

@section('title', 'Edit Task')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-tasks text-primary mr-2"></i> Edit Task</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('taskmanagment.index') }}">Task Management</a></li>
                <li class="breadcrumb-item active">Edit Task</li>
            </ol>
        </div>
        <a href="{{ route('taskmanagment.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-list"></i> All Tasks
        </a>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> Edit Task</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('taskmanagment.savetask') }}" method="POST" id="taskForm">
                @csrf
                  <input type="text" name="id" id="id" value="{{ $tasks->task_id }}" hidden> 
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {{ session('error') }}
                        </div>
                    @endif
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Task Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                     </div>
                                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter task name" value="{{ $tasks->task_name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                    @enderror 
                                </div>
                                <small class="form-text text-muted">Provide a clear, descriptive name for the task</small>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="desc">Task Description <span class="text-danger">*</span></label>
                        <textarea name="desc" class="form-control @error('desc') is-invalid @enderror"
                            id="desc" rows="3" placeholder="Enter detailed task description" required>{{ old('desc') }}</textarea>
                        @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Include all necessary details about what needs to be accomplished</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Task Priority <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                    </div>
                                    <select name="priority" id="priority" class="form-control select2 @error('priority') is-invalid @enderror" required>
                                        <option value="">-- Select Priority --</option>
                                        <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>
                                            <span class="text-success">Low</span>
                                        </option>
                                        <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>
                                            <span class="text-info">Medium</span>
                                        </option>
                                        <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>
                                            <span class="text-warning">High</span>
                                        </option>
                                        <option value="4" {{ old('priority') == '4' ? 'selected' : '' }}>
                                            <span class="text-danger">Very High</span>
                                        </option>
                                    </select>
                                    @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task Status <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <div class="custom-control custom-radio mr-4">
                                        <input class="custom-control-input" type="radio" id="active" name="status" value="pending" checked>
                                        <label for="active" class="custom-control-label">
                                            <span class="badge badge-success">Pending</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="inactive" name="status" value="completed">
                                        <label for="inactive" class="custom-control-label">
                                            <span class="badge badge-secondary">Completed</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="inactive" name="status" value="working">
                                        <label for="inactive" class="custom-control-label">
                                            <span class="badge badge-secondary">Working</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="inactive" name="status" value="overdue">
                                        <label for="inactive" class="custom-control-label">
                                            <span class="badge badge-secondary">Over Due</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <div class="input-group date" id="due_date_picker" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#due_date_picker" data-toggle="datetimepicker">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="due_date" class="form-control datetimepicker-input @error('due_date') is-invalid @enderror" 
                                        data-target="#due_date_picker" placeholder="YYYY-MM-DD" value="{{ old('due_date') }}">
                                    @error('due_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assignee">Assign To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select name="assignee" id="assignee" class="form-control select2 @error('assignee') is-invalid @enderror">
                                        <option value="">-- Select Team Member --</option>
                                        {{-- @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('assignee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Task
                    </button>
                    <button type="reset" class="btn btn-secondary ml-2">
                        <i class="fas fa-undo mr-1"></i> Reset
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
    <style>
        /* Priority colors */
        .priority-low { color: #28a745; }
        .priority-medium { color: #17a2b8; }
        .priority-high { color: #ffc107; }
        .priority-very-high { color: #dc3545; }
        
        /* Custom Select2 styling */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
            padding-left: 0;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
        }
    </style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script>
    $(function () {
        //Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        //Initialize Date picker
        $('#due_date_picker').datetimepicker({
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
        
        // Priority select coloring
        $('#priority').on('change', function() {
            let value = $(this).val();
            let text;
            let colorClass;
            
            switch(value) {
                case '1':
                    text = 'Low';
                    colorClass = 'priority-low';
                    break;
                case '2':
                    text = 'Medium';
                    colorClass = 'priority-medium';
                    break;
                case '3':
                    text = 'High';
                    colorClass = 'priority-high';
                    break;
                case '4':
                    text = 'Very High';
                    colorClass = 'priority-very-high';
                    break;
                default:
                    text = 'Select Priority';
                    colorClass = '';
            }
            
            $(this).removeClass('priority-low priority-medium priority-high priority-very-high')
                .addClass(colorClass);
        });
        
        // Form validation
        $('#taskForm').submit(function(event) {
            let isValid = true;
            
            // Reset validation styling
            $('.is-invalid').removeClass('is-invalid');
            
            // Validate required fields
            if ($('#name').val().trim() === '') {
                $('#name').addClass('is-invalid');
                isValid = false;
            }
            
            if ($('#desc').val().trim() === '') {
                $('#desc').addClass('is-invalid');
                isValid = false;
            }
            
            if ($('#createdby').val().trim() === '') {
                $('#createdby').addClass('is-invalid');
                isValid = false;
            }
            
            if ($('#priority').val() === '') {
                $('#priority').addClass('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                event.preventDefault();
                // Scroll to first error
                $('html, body').animate({
                    scrollTop: $('.is-invalid:first').offset().top - 100
                }, 500);
            }
        });
    });
</script>
@stop