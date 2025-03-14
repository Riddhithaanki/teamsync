@extends('adminlte::page')

@section('title', 'Attendance Management')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Attendance Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('attendences.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Attendance
                        </a>
                    </div>
                    
                        <table id="projects-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time-In</th> 
                                    <th>Time-out</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach ($attendences as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>
                                        <span class="name">{{ $list->user_name }}</span>
                                    </td>
                                    <td>{{ $list->date }}</td>
                                    <td>{{ $list->time_in }}</td>
                                    <td>{{ $list->time_out }}</td>
                                    <td>{{ $list->status }}</td>
                                    <td>{{ $list->location }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('attendences.edit', \Crypt::encrypt($list->id)) }}"
                                                class="btn btn-warning btn-sm mx-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <a href="{{ route('attendences.delete', ['id' => Crypt::encrypt($list->id)]) }}"
                                                class="btn btn-danger btn-sm mx-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
