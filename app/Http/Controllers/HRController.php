<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class HRController extends Controller
{
    // public function index()
    // {   
    //     if(role==hr){
    //         return view('hr.dashboard');
    //     }

    // }
    public function dashboard()
    {
        $user = User::get();
        $role = auth()->user()->role; // Assuming 'role' is stored in the users table

        if ($role == 'hr') {
            return view('hr.dashboard');
        } elseif ($role == 'admin') {
            return view('admin.dashboard');
        } elseif ($role == 'techlead') {
            return view('techlead.dashboard');
        } elseif ($role == 'developer') {
            return view('developer.dashboard');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
