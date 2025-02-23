@extends('adminlte::page')

@section('title', 'Project Management')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Project Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{ route('dashboard') }} ">Home</a></li>
                    <li class="breadcrumb-item active">Projects</li>
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
                        <h3 class="card-title">Project List</h3>
                        <div class="card-tools">
                            <a href="{{ route('taskmanagment.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Project
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="projects-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SR No</th>
                                    <th>Project Name</th>
                                    <th>Description </th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Assign</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key => $project)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <span class="name">{{ $project->project_name }}</span>
                                        </td>
                                        <td>{{ $project->project_desc }}</td>
                                        <td>{{ $project->project_start_date }}</td>
                                        <td>{{ $project->project_end_date }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info"> Create Task </button>
                                            <button class="btn btn-sm btn-success"> Assign Task </button>
                                            <button class="btn btn-sm btn-success"> Assign User </button>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('employees.edit', \Crypt::encrypt($project->id)) }}"
                                                    class="btn btn-warning btn-sm mx-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('employees.edit', \Crypt::encrypt($project->id)) }}"
                                                    class="btn btn-success btn-sm mx-2" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('employees.edit', \Crypt::encrypt($project->id)) }}"
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#projects-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
