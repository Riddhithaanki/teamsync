@extends('adminlte::page')

@section('title', 'Chat Management')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chat Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left sidebar for user list -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                   
                    <div class="card-tools">
                        <form class="input-group input-group-sm">
                            <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <nav class="navbar navbar-light bg-light mb-2">
                        <form class="container-fluid justify-content-start">
                            <a href="{{route('chats')}}" class="btn btn-sm btn-outline-success me-3">People</a>
                            <button class="btn btn-sm btn-outline-success me-2" type="button">Group</button>
                        </form>
                    </nav>
                    
                    <div class="list-group list-group-flush">
                        @foreach($users as $user)
                            <a href="{{route('showchat.index', \Crypt::encrypt($user->id))}}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-user-circle mr-2"></i>
                                        {{ $user->name }}
                                    </div>
                                    <span class="badge bg-success rounded-pill">●</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
@endsection