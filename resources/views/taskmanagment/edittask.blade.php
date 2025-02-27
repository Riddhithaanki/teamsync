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
        <i class="fas fa-list mr-1"></i> All Tasks
    </a>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Edit Task</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('taskmanagment.updateTask') }}" method="POST" id="taskForm">
                @csrf
                <input type="hidden" name="id" value="{{ $task->task_id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Task Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        id="name" value="{{ $task->task_name }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Task Priority <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                    </div>
                                    <select name="priority" id="priority"
                                        class="form-control select2 @error('priority') is-invalid @enderror" required>
                                        <option value="">Select Priority</option>
                                        <option value="1" {{ $task->task_priority == 1 ? 'selected' : '' }}>Low</option>
                                        <option value="2" {{ $task->task_priority == 2 ? 'selected' : '' }}>Medium</option>
                                        <option value="3" {{ $task->task_priority == 3 ? 'selected' : '' }}>High</option>
                                        <option value="4" {{ $task->task_priority == 4 ? 'selected' : '' }}>Very High</option>
                                    </select>
                                    @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc">Task Description <span class="text-danger">*</span></label>
                        <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc"
                            rows="3" required>{{ $task->task_desc }}</textarea>
                        @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <div class="input-group date" id="due_date_container" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#due_date_container" data-toggle="datetimepicker">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="due_date" id="due_date"
                                        class="form-control datetimepicker-input @error('due_date') is-invalid @enderror"
                                        data-target="#due_date_container" value="{{ $task->task_due_date }}">
                                    @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task Status <span class="text-danger">*</span></label>
                                <div class="d-flex flex-wrap">
                                    <div class="custom-control custom-radio mr-4 mb-2">
                                        <input class="custom-control-input" type="radio" id="pending" name="status"
                                            value="pending" {{ $task->task_status == 'pending' ? 'checked' : '' }}>
                                        <label for="pending" class="custom-control-label"><span
                                                class="badge badge-primary">Pending</span></label>
                                    </div>
                                    <div class="custom-control custom-radio mr-4 mb-2">
                                        <input class="custom-control-input" type="radio" id="working" name="status"
                                            value="working" {{ $task->task_status == 'working' ? 'checked' : '' }}>
                                        <label for="working" class="custom-control-label"><span
                                                class="badge badge-info">Working</span></label>
                                    </div>
                                    <div class="custom-control custom-radio mr-4 mb-2">
                                        <input class="custom-control-input" type="radio" id="completed" name="status"
                                            value="completed" {{ $task->task_status == 'completed' ? 'checked' : '' }}>
                                        <label for="completed" class="custom-control-label"><span
                                                class="badge badge-success">Completed</span></label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input class="custom-control-input" type="radio" id="overdue" name="status"
                                            value="overdue" {{ $task->task_status == 'overdue' ? 'checked' : '' }}>
                                        <label for="overdue" class="custom-control-label"><span 
                                                class="badge badge-danger">Overdue</span></label>
                                    </div>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Task
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
    .select2-container--default .select2-results__option[data-priority="1"] {
        color: #28a745;
    }
    
    .select2-container--default .select2-results__option[data-priority="2"] {
        color: #17a2b8;
    }
    
    .select2-container--default .select2-results__option[data-priority="3"] {
        color: #ffc107;
    }
    
    .select2-container--default .select2-results__option[data-priority="4"] {
        color: #dc3545;
        font-weight: bold;
    }
    
    .priority-1 .select2-selection__rendered {
        color: #28a745 !important;
    }
    
    .priority-2 .select2-selection__rendered {
        color: #17a2b8 !important;
    }
    
    .priority-3 .select2-selection__rendered {
        color: #ffc107 !important;
    }
    
    .priority-4 .select2-selection__rendered {
        color: #dc3545 !important;
        font-weight: bold;
    }

    /* Custom Select2 styling */
    .select2-container--bootstrap .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
    }

    .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
        line-height: 1.5;
    }

    .select2-container--bootstrap .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px);
    }
    
    /* Custom styling for form elements */
    .custom-control-label {
        cursor: pointer;
    }
    
    .card-primary.card-outline {
        border-top: 3px solid #007bff;
    }
    
    /* Form validation styling */
    .is-invalid ~ .select2-container .select2-selection {
        border-color: #dc3545;
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script>
    $(function () {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap',
            templateResult: formatPriority,
            templateSelection: formatPriority
        });
        
        // Set initial priority class
        updatePriorityClass($('#priority').val());
        
        // Initialize DateTime picker
        $('#due_date_container').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar-alt',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'fas fa-times'
            }
        });
        
        // Format priority options
        function formatPriority(option) {
            if (!option.id) {
                return option.text;
            }
            
            $(option.element).attr('data-priority', option.id);
            return option.text;
        }
        
        // Priority select coloring
        $('#priority').on('change', function () {
            updatePriorityClass($(this).val());
        });
        
        function updatePriorityClass(value) {
            let select = $('#priority');
            let parent = select.parent().find('.select2-container');
            
            // Remove all priority classes
            parent.removeClass('priority-1 priority-2 priority-3 priority-4');
            
            // Add appropriate class
            if (value) {
                parent.addClass('priority-' + value);
            }
        }

        // Form validation
        $('#taskForm').submit(function (event) {
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

            if ($('#priority').val() === '') {
                $('#priority').addClass('is-invalid');
                isValid = false;
            }
            
            if (!$('input[name="status"]:checked').length) {
                $('.text-danger').text('Please select a status');
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