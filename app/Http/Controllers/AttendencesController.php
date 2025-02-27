<?php

namespace App\Http\Controllers;
use App\Models\Attendences;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendencesController extends Controller
{
    public function index() {
        $attendences= Attendences::get();
        return view('attendences.index',compact('attendences'));
    }

   
}
