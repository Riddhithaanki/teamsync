@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Employee Information</h3>
                </div>

                <form action="{{ route('employees.updateData') }}" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" value="{{ $employeeData->id }}" hidden>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Enter full name" value="{{ $employeeData->user->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter email" value="{{ $employeeData->user->email }}" required>
                                    @error('email')
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
                                    <label for="phone">Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="Enter phone number" value="{{ $employeeData->phone }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control select2 @error('role') is-invalid @enderror"
                                        id="role">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ $employeeData->user->role == 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                        <option value="hr" {{ $employeeData->user->role == 'hr' ? 'selected' : '' }}>HR
                                        </option>
                                        <option value="tech_lead"
                                            {{ $employeeData->user->role == 'tech_lead' ? 'selected' : '' }}>Tech Lead
                                        </option>
                                        <option value="developer"
                                            {{ $employeeData->user->role == 'developer' ? 'selected' : '' }}>Developer
                                        </option>
                                    </select>

                                    @error('role')
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
                                    <label for="salary">Salary</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="salary"
                                            class="form-control @error('salary') is-invalid @enderror" id="salary"
                                            placeholder="Enter salary" value="{{ $employeeData->salary }}">
                                        @error('salary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="joining_date">Joining Date</label>
                                    <div class="input-group date" id="joining_date_picker" data-target-input="nearest">
                                        <input type="text" name="joining_date"
                                            class="form-control datetimepicker-input @error('joining_date') is-invalid @enderror"
                                            data-target="#joining_date_picker" value="{{ $employeeData->joining_date }}"
                                            required>
                                        <div class="input-group-append" data-target="#joining_date_picker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('joining_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Employee
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-default float-right">
                            <i class="fas fa-times-circle mr-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script>
        $(function() {
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
