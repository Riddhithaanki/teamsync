<?php
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;

class ChatController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('chat.index', compact('employees'));
    }
    public function seen(Request $request)
{
    try {
        $message = Message::where('from_id', $request->from_id)
                          ->where('to_id', $request->to_id)
                          ->update(['seen' => true]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}