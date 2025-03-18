@extends('layouts.app')
@extends('adminlte::page')

@section('title', 'Group Management')

@section('content_header')
<div class="container py-4">
    <div class="row">
        <!-- Left Column: Create Group -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i>Create New Group</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('groups.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="group_name" class="form-label fw-bold">Group Name:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <input type="text" name="name" id="group_name" class="form-control" placeholder="Enter a memorable name" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user-friends me-1"></i> Select Members:
                            </label>
                            <div class="card">
                                <div class="card-body p-2 member-selection-area" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($users as $user)
                                        <div class="form-check d-flex align-items-center py-2 border-bottom">
                                            <input type="checkbox" name="users[]" value="{{ $user->id }}" id="user{{ $user->id }}" class="form-check-input me-2">
                                            <label class="form-check-label d-flex align-items-center w-100" for="user{{ $user->id }}">
                                                <div class="avatar-circle me-2 bg-light text-primary">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <span class="user-name">{{ $user->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Create Group
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Right Column: Group List -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-list me-2"></i>My Groups</h4>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($groups as $group)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center p-2">
                                <div class="group-avatar me-3 bg-primary text-white">
                                    {{ substr($group->name, 0, 2) }}
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">{{ $group->name }}</h5>
                                    <small class="text-muted">{{ $group->users->count() }} members</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success rounded-pill me-3">Active</span>
                                    <a href="{{route('groups.groupchat',\Crypt::encrypt($group->id))}}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-comments"></i> Chat
                                    </a>
                                    <form action="{{ route('groups.delete',\Crypt::encrypt($group->id)) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this group?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center py-5">
                            <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                            <p class="mb-0">No groups found. Create your first group!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for custom elements -->
<style>
    .group-avatar {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
    }
    
    .avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .member-selection-area::-webkit-scrollbar {
        width: 6px;
    }
    
    .member-selection-area::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .member-selection-area::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .member-selection-area::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<!-- Include Font Awesome if not already in your layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection