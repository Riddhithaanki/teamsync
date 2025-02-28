<?php

namespace App\Http\Controllers;
use App\Models\Attendences;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendencesController extends Controller
{
    public function index() {
        $attendences= Attendences::get();
        return view('attendences.index',compact('attendences'));
    }

    public function create(){
        return view('attendences.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required',
            'time_in'=> 'required',
            'status'=> 'required',
            'location' => 'required',           
        ]);


        $attendences = new Attendences();
        $attendences->user_id = 5;
        $attendences->user_name = $request->name;
        $attendences->date = $request->date;
        $attendences->location = $request->location;
        $attendences->status = $request->status;
        $attendences->time_in = carbon::createFromFormat('h:i:s A', $request->time_in)->format('H:i:s');
        $attendences->time_out = carbon::createFromFormat('h:i:s A', $request->time_in)->format('H:i:s');
        $attendences->save();

        $user = New User();
        $user->name = $request->name;
    
        return redirect()->route('attendences.index')->with('success', 'Attendence added successfully!');
    }

    public function edit($id){
        $attendences = Attendences::get();
        $id = Crypt::decrypt($id);
        $attendences = attendences::where('id', $id)->first();
        
        return view('attendences.edit',compact('attendences'));
    }

}
