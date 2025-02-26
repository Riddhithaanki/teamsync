@extends('adminlte::page')

@section('title', 'Project Detail')

@section('content_header')
<h1 class="m-0">{{ $project->project_name }}</h1>
@stop

@section('content')
<div class="row">
    <!-- Project Overview Card -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Project Overview</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-muted">Project Status</span>
                                <span class="info-box-number text-success">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="text-muted">Project Details</h5>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9">{{ $project->project_desc }}</dd>

                        <dt class="col-sm-3">Technologies</dt>
                        <dd class="col-sm-9">
                            @foreach(explode(',', $project->project_tech) as $tech)
                                <span class="badge badge-info">{{ trim($tech) }}</span>
                            @endforeach
                        </dd>

                        <dt class="col-sm-3">Timeline</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($project->project_start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($project->project_end_date)->format('d M Y') }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Stats Card -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title">Project Statistics</h3>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Tasks</span>
                            <span class="badge badge-primary">24</span>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Completed Tasks</span>
                            <span class="badge badge-success">16</span>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Pending Tasks</span>
                            <span class="badge badge-warning">8</span>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Team Members</span>
                            <span class="badge badge-info">6</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Team -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Project Team</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                        <tbody>
                            <tr>
                                <td>{{$user->name }}</td>
                                <td>{{$user->email }}</td>
                                <td>{{$user->role }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Tasks -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h3 class="card-title">Recent Tasks</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->task_name }}</td>
                                    @if($task->status == 0)
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    @elseif ($task->status == 1)
                                        <td><span class="badge badge-success">Completed</span></td>
                                    @elseif ($task->status == 2)
                                        <td><span class="badge badge-info">Working</span></td>
                                    @elseif ($task->status == 3)
                                        <td><span class="badge badge-danger">Over Due</span></td>
                                    @endif
                                    <td>{{ $task->task_due_date }}</td>
                                        </tr>
                            @endforeach
                                <!-- Add more tasks as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<style>
    .users-list>li {
        float: left;
        padding: 10px;
        text-align: center;
        width: 25%;
    }

    .users-list>li img {
        border-radius: 50%;
        height: 64px;
        width: 64px;
    }

    .users-list-name {
        display: block;
        font-size: 0.9rem;
        color: #495057;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .users-list-role {
        color: #6c757d;
        font-size: 0.8rem;
    }

    .timeline {
        margin: 0;
        padding: 0;
        position: relative;
    }

    .timeline::before {
        background-color: #dee2e6;
        bottom: 0;
        content: '';
        left: 31px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 2px;
    }

    .timeline>div {
        margin-bottom: 15px;
        margin-right: 10px;
        position: relative;
    }

    .timeline>div>i {
        background-color: #adb5bd;
        border-radius: 50%;
        font-size: 16px;
        height: 30px;
        left: 18px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
        color: #fff;
    }

    .timeline-item {
        background-color: #fff;
        border-radius: 3px;
        margin-left: 60px;
        margin-right: 15px;
        margin-top: 0;
        padding: 0;
        position: relative;
    }

    .timeline-header {
        border-bottom: 1px solid #f4f4f4;
        color: #495057;
        font-size: 16px;
        line-height: 1.1;
        margin: 0;
        padding: 10px;
    }

    .timeline-body {
        padding: 10px;
    }

    .time {
        color: #999;
        float: right;
        padding: 10px;
    }
</style>
@stop