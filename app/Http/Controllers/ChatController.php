<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function index() {
        return view("chat.index");
    }
}