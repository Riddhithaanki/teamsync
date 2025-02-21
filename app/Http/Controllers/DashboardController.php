<?php
namespace App\Http\Controllers; 

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Ensure dashboard.blade.php exists
    }
    public function admin()
    {
        return view('dashboards.admin');
    }

    public function hr()
    {
        return view('dashboards.hr');
    }

    public function techLead()
    {
        return view('dashboards.techlead');
    }

    public function developer()
    {
        return view('dashboards.developer');
    }
}





