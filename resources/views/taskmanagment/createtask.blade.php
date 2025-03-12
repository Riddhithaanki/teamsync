@extends('adminlte::page')

@section('title', 'Add Task')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-tasks text-primary mr-2"></i> Add New Task</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('taskmanagment.index') }}">Task Management</a></li>
                <li class="breadcrumb-item active">Add Task</li>
            </ol>
        </div>
        <a href="{{ route('taskmanagment.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-list mr-1"></i> All Tasks
        </a>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary text-white">
                <h3 class="card-title"><i class="fas fa-clipboard-check mr-2"></i> Create New Task</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('taskmanagment.savetask') }}" method="POST" id="taskForm">
                @csrf
                <input type="text" name="id" id="id" value="{{ $project->id }}" hidden>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check-circle"></i> Success!</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                            {{ session('error') }}
                        </div>
                    @endif
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Task Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-clipboard-list"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter descriptive task name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> Provide a clear, descriptive name for the task</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority" class="font-weight-bold">Task Priority <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-flag"></i></span>
                                    </div>
                                    <select name="priority" id="priority" class="form-control form-control-lg select2 @error('priority') is-invalid @enderror" required>
                                        <option value="">-- Select Priority --</option>
                                        <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>
                                            <span class="priority-low">Low</span>
                                        </option>
                                        <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>
                                            <span class="priority-medium">Medium</span>
                                        </option>
                                        <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>
                                            <span class="priority-high">High</span>
                                        </option>
                                        <option value="4" {{ old('priority') == '4' ? 'selected' : '' }}>
                                            <span class="priority-very-high">Very High</span>
                                        </option>
                                    </select>
                                    @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> Set the urgency level for this task</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="desc" class="font-weight-bold">Task Description <span class="text-danger">*</span></label>
                        <textarea name="desc" class="form-control @error('desc') is-invalid @enderror"
                            id="desc" rows="4" placeholder="Enter detailed task description with all necessary information" required>{{ old('desc') }}</textarea>
                        @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> Include all necessary details about what needs to be accomplished</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date" class="font-weight-bold">Due Date</label>
                                <div class="input-group date" id="due_date_picker" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#due_date_picker" data-toggle="datetimepicker">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="due_date" class="form-control form-control-lg datetimepicker-input @error('due_date') is-invalid @enderror" 
                                        data-target="#due_date_picker" placeholder="YYYY-MM-DD" value="{{ old('due_date') }}">
                                    @error('due_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> When should this task be completed?</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assignee" class="font-weight-bold">Assign To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <select name="assignee" id="assignee" class="form-control form-control-lg select2 @error('assignee') is-invalid @enderror">
                                        <option value="">-- Select Team Member --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('assignee') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assignee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> Who will be responsible for this task?</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4">
                        <label class="font-weight-bold">Task Status <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap status-container p-3 bg-light rounded">
                            <div class="custom-control custom-radio status-item mr-4 mb-2">
                                <input class="custom-control-input" type="radio" id="pending" name="status" value="pending" checked>
                                <label for="pending" class="custom-control-label">
                                    <span class="badge badge-pill badge-warning px-3 py-2"><i class="fas fa-hourglass-start mr-1"></i> Pending</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio status-item mr-4 mb-2">
                                <input class="custom-control-input" type="radio" id="working" name="status" value="working" {{ old('status') == 'working' ? 'checked' : '' }}>
                                <label for="working" class="custom-control-label">
                                    <span class="badge badge-pill badge-info px-3 py-2"><i class="fas fa-spinner mr-1"></i> Working</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio status-item mr-4 mb-2">
                                <input class="custom-control-input" type="radio" id="completed" name="status" value="completed" {{ old('status') == 'completed' ? 'checked' : '' }}>
                                <label for="completed" class="custom-control-label">
                                    <span class="badge badge-pill badge-success px-3 py-2"><i class="fas fa-check-circle mr-1"></i> Completed</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio status-item mb-2">
                                <input class="custom-control-input" type="radio" id="overdue" name="status" value="overdue" {{ old('status') == 'overdue' ? 'checked' : '' }}>
                                <label for="overdue" class="custom-control-label">
                                    <span class="badge badge-pill badge-danger px-3 py-2"><i class="fas fa-exclamation-circle mr-1"></i> Overdue</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="fas fa-save mr-2"></i> Save Task
                    </button>
                    <button type="reset" class="btn btn-lg btn-secondary ml-2">
                        <i class="fas fa-undo mr-2"></i> Reset
                    </button>
                    <a href="{{ route('taskmanagment.index') }}" class="btn btn-lg btn-default float-right">
                        <i class="fas fa-times-circle mr-2"></i> Cancel
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
        /* Overall styles */
        .card {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-control, .input-group-text, .select2-selection {
            border-radius: 6px;
        }
        
        .input-group-text {
            width: 45px;
        }
        
        /* Priority colors with improved contrast */
        .priority-low { color: #1e7e34; font-weight: bold; }
        .priority-medium { color: #138496; font-weight: bold; }
        .priority-high { color: #d39e00; font-weight: bold; }
        .priority-very-high { color: #bd2130; font-weight: bold; }
        
        /* Status container styling */
        .status-container {
            border-radius: 8px;
        }
        
        .status-item {
            transition: transform 0.2s ease;
        }
        
        .status-item:hover {
            transform: translateY(-2px);
        }
        
        .badge {
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Button styling */
        .btn {
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
        }
        
        .btn-primary {
            box-shadow: 0 4px 6px rgba(0,105,217,0.2);
        }
        
        .btn-primary:hover {
            box-shadow: 0 6px 8px rgba(0,105,217,0.3);
            transform: translateY(-2px);
        }
        
        /* Custom Select2 styling */
        .select2-container--default .select2-selection--single {
            height: calc(2.875rem + 2px);
            padding: .5rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.75;
            padding-left: 0;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.875rem + 2px);
        }
        
        /* Form validations */
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        
        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
        }
        
        /* Animation for alerts */
        .alert {
            animation: fadeInDown 0.5s ease;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            theme: 'bootstrap4',
            width: '100%'
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
        
        // Apply initial priority color
        $('#priority').trigger('change');
        
        // Form validation with improved feedback
        $('#taskForm').submit(function(event) {
            let isValid = true;
            
            // Reset validation styling
            $('.is-invalid').removeClass('is-invalid');
            
            // Validate required fields
            if ($('#name').val().trim() === '') {
                $('#name').addClass('is-invalid').parent().append('<div class="invalid-feedback">Task name is required</div>');
                isValid = false;
            }
            
            if ($('#desc').val().trim() === '') {
                $('#desc').addClass('is-invalid').parent().append('<div class="invalid-feedback">Task description is required</div>');
                isValid = false;
            }
            
            if ($('#priority').val() === '') {
                $('#priority').addClass('is-invalid').parent().append('<div class="invalid-feedback">Please select a priority level</div>');
                isValid = false;
            }
            
            if (!isValid) {
                event.preventDefault();
                
                // Add shake animation to first invalid field
                $('.is-invalid:first').parent().addClass('shake-animation');
                
                // Scroll to first error with smooth animation
                $('html, body').animate({
                    scrollTop: $('.is-invalid:first').offset().top - 100
                }, 500);
            }
        });
        
        // Remove animations after they complete
        $('form').on('animationend', '.shake-animation', function() {
            $(this).removeClass('shake-animation');
        });
        
        // Automatically dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@stop