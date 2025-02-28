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
        $attendences->id = $request->id;
        $attendences->user_name = $request->name;
        $attendences->date = $request->date;
        $attendences->location = $request->location;
        $attendences->status = $request->status;
        $attendences->time_in = $request->time_in;
        $attendences->time_out = $request->time_out;
        $attendences->save();

        $user = New User();
        $user->user_name = $request->name;
        //$user->user_id = $request->id;
    
        return redirect()->route('attendences.index')->with('success', 'Attendence added successfully!');
    }

    public function edit($id){
       // $attendences = Attendences::get();
        $id = Crypt::decrypt($id);
        $attendences = Attendences::where('id', $id)->first();
        //dd($attendences);
        return view('attendences.edit',compact('attendences'));
      
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'status' => 'nullable',
            'location' => 'required',
            'time_in' => 'required'
        ]);
        $attendences = Attendences::findOrFail($request->id);
        $attendences->user_name = $request->name;
        $attendences->date= $request->date;
        $attendences->status = $request->status;
        $attendences->location = $request->location;
        $attendences->time_in = Carbon::createFromFormat('h:i A', $request->time_in)->format('H:i:s');
        $attendences->time_out = Carbon::createFromFormat('h:i A', $request->time_out)->format('H:i:s');
        $attendences->save();

        return redirect()->route('attendences.index')->with('success', 'Attendences update succesfully ');
    }


    public function delete($id){
        $id = Crypt::decrypt($id);
        $attendences = Attendences::whereId($id)->first();
        $attendences->delete();
        return view('attendences.index')->with('success','Attendence Delete Successfully');
    }
}
