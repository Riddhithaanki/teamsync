<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function index() {
        $attendances = Attendance::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function markAttendance(Request $request) {
        $user = Auth::user();
        $date = now()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->where('date', $date)->first();

        if (!$attendance) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $date,
                'check_in' => now()->toTimeString(),
            ]);
            return back()->with('success', 'Check-in recorded successfully.');
        }

        if (!$attendance->check_out) {
            $attendance->update(['check_out' => now()->toTimeString()]);
            return back()->with('success', 'Check-out recorded successfully.');
        }

        return back()->with('error', 'Attendance already marked for today.');
    }
}
