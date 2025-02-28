@extends('adminlte::page')

@section('title', 'Add Attendance')

@section('content_header')
    <h1>Add Attendance</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Attendance Information</h3>
            </div>

            <form action="{{ route('attendences.save') }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- First Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Second Row -->
                    <div class="row">
                        <!-- Time In -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time_in">Time In</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" name="time_in" class="form-control @error('time_in') is-invalid @enderror" 
                                           id="time_in" value="{{ old('time_in', $attendences->time_in ?? '') }}">
                                    @error('time_in')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Time Out -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time_out">Time Out</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" name="time_out" class="form-control @error('time_out') is-invalid @enderror" 
                                           id="time_out" value="{{ old('time_out', $attendences->time_out ?? '') }}">
                                    @error('time_out')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Third Row -->
                    <div class="row">
                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                               
                                <label for="status">Status</label>
                                <select name="status" class="form-control select2 @error('status') is-invalid @enderror" id="status">
                                    <option value="">Select Status</option>
                                    <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                   
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Location -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select name="location" class="form-control select2 @error('location') is-invalid @enderror" id="location">
                                    <option value="">Select location</option>
                                    <option value="office" {{ old('location') == 'office' ? 'selected' : '' }}>Office</option>
                                    <option value="online" {{ old('location') == 'online' ? 'selected' : '' }}>Online</option>
                                </select>
                                @error('location')
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
                        <i class="fas fa-save mr-1"></i> Save Attendance
                    </button>
                    <a href="{{ route('attendences.create') }}" class="btn btn-default float-right">
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
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(function () {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        // Auto-fill Time In on Page Load
        if (document.getElementById('time_in') && !document.getElementById('time_in').value) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('time_in').value = `${hours}:${minutes}`;
        }
    });

    // Set Time Out function
    function setTimeOut() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('time_out').value = `${hours}:${minutes}`;
    }
</script>
@stop