<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechLeadController extends Controller
{
    public function index()
    {
        return view('techlead.dashboard'); // Make sure this view exists
    }
}
