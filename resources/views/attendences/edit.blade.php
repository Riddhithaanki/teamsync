@extends('adminlte::page')

@section('title', 'Add Attendence')

@section('content_header')
    <h1>Edit Attendence</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Attendence Information</h3>
            </div>

            <form action="{{ route('attendences.update') }}" method="POST">
                @csrf
                <input type="text" name="id" id="id" value="{{ $attendences->id }}" hidden>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Enter full name" value="{{ old('name', $attendences->user_name ?? '') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    
                    
                    <!--date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                id="date" value="{{old('name',$attendences->date ??'')}}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div></div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time_in" class="text-primary">
                                    <i class="fas fa-clock mr-1"></i> Time In
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="time_in" class="form-control @error('time_in') is-invalid @enderror" 
                                        id="time_in" value="{{ old('time_in', \Carbon\Carbon::parse($attendences->time_in ?? '')->format('h:i A')) }}" required>                                
                                        
                                       
                                        {{-- @error('time_in')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time_out" class="text-primary">
                                    <i class="fas fa-clock mr-1"></i> Time Out
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" name="time_out" class="form-control @error('time_out') is-invalid @enderror" 
                                    id="time_out" value="{{ old('time_out', \Carbon\Carbon::parse($attendences->time_out ?? '')->format('h:i A')) }}" required>
                                    
                                    {{-- @error('time_out')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        
                        
                    <div class="row">
                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control select2 @error('status') is-invalid @enderror" id="status">
                                    <option value="{{$attendences->status}}">Select Status</option>
                                    <option value="present" {{ old('status',$attendences->status) == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ old('status',$attendences->status) == 'absent' ? 'selected' : '' }}>Absent</option>
                                    <option value="late" {{ old('status',$attendences->status) == 'late' ? 'selected' : '' }}>Late</option>
                                    <option value="on_leave" {{ old('status',$attendences->status) == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Location (Latitude & Longitude) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select name="location" class="form-control select2 @error('location') is-invalid @enderror" id="location">
                                    <option value="{{$attendences->location}}">Select Location</option>
                                    <option value="office" {{ old('location', $attendences->location) == 'office' ? 'selected' : '' }}>Office</option>
                                    <option value="online" {{ old('location', $attendences->location) == 'online' ? 'selected' : '' }}>Online</option>
                                </select>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <!-- Button for Time Out -->
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-danger" onclick="setTimeOut()">Time Out</button>
                    </div>
                    

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Attendence
                    </button>
                    <a href="{{route('attendences.create')}}" class="btn btn-default float-right">
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

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('location').value = 
                    position.coords.latitude + ', ' + position.coords.longitude;
            }, function(error) {
                alert('Error fetching location: ' + error.message);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Auto-fill Time In on Page Load
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('time_in').value = new Date().toLocaleTimeString();
    });

    // Auto-fill Time Out when button clicked
    function setTimeOut() {
        document.getElementById('time_out').value = new Date().toLocaleTimeString();
    }
</script>

@stop
