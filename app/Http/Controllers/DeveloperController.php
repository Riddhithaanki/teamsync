<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.dashboard'); // Make sure this view exists
    }
}