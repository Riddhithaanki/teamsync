@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Group</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="group_name" class="form-label">Group Name:</label>
            <input type="text" name="name" id="group_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Members:</label>
            @foreach($users as $user)
                <div class="form-check">
                    <input type="checkbox" name="users[]" value="{{ $user->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $user->name }}</label>
                </div>
            @endforeach

        </div>
   <div> 
    <h2>group name</h2>
    @foreach($groups as $group)
     <label>   {{ $group->name }}</label>
    @endforeach
   </div>
        <button type="submit" class="btn btn-primary">Create Group</button>
    </form>
</div>
@endsection

{{-- <select name="users[]" multiple id="userSelect" class="form-control">
    @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach --}}
{{-- </select> --}}

{{-- <select name="users[]" multiple id="userSelect" class="form-control">
    @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
</select> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userSelect').select2({
            placeholder: "Select group members",
            allowClear: true
        });
    });
</script> --}}
