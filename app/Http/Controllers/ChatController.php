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
}