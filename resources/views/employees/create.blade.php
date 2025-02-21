@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role:</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="hr">HR</option>
                <option value="tech_lead">Tech Lead</option>
                <option value="developer">Developer</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Salary:</label>
            <input type="number" name="salary" class="form-control">
        </div>
        <div class="mb-3">
            <label>Joining Date:</label>
            <input type="date" name="joining_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
</div>
@endsection
