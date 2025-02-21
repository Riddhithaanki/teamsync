<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRController extends Controller
{
    public function index()
    {
        return view('hr.dashboard'); // Make sure this view exists
    }
}