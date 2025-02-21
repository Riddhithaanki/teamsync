@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('attendance.mark') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Mark Attendance</button>
    </form>

    <h3 class="mt-4">Your Attendance History</h3>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Date</th>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->check_in ?? 'Not Checked In' }}</td>
                    <td>{{ $attendance->check_out ?? 'Not Checked Out' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
