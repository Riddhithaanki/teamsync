<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Laravel\Pail\ValueObjects\Origin\Console;

class TaskManagmentController extends Controller
{
    public function index()
    {
        $projects = Project::get();

        return view('taskmanagment.index',compact('projects')); // Make sure this view exists

    }
    public function create()
    {
        return view('taskmanagment.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'tech' => 'nullable',
            'sdate' => 'required',
            'edate' => 'required'
        ]);
        if ($errors = $request->session()->get('errors')) {
            dd($errors->all());
        }// This will stop execution and show validation errors

        try {
            $project = new Project();
            $project->created_by_id = Auth::id(); // Store the logged-in user's ID
            $project->project_name = $request->name;
            $project->project_desc = $request->desc;
            $project->project_tech = $request->tech;
            $project->project_start_date = date('Y-m-d H:i:s', strtotime($request->sdate));
            $project->project_end_date = date('Y-m-d H:i:s', strtotime($request->edate));
            $project->save();

            return redirect()->route('taskmanagment.index')->with('success', 'Project added successfully!');
        } catch (\Exception $e) {
            // return back()->withErrors('Failed to save project. Error: ' . $e->getMessage());
            return redirect()->route('taskmanagment.index')->with('error', 'Failed to save project. Error: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $projects = Project::get();
        $id = Crypt::decrypt($id);
        // $employee = Employee::findOrFail($id);
        $project = Project::where('id', $id)->first();
        return view('taskmanagment.edit', compact('project'));
    }
    public function update(Request $request , $id){
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'tech' => 'nullable',
            'sdate' => 'required',
            'edate' => 'required'
        ]);

           $project = Project::findOrFail($request->id);
           $project->name = $request->name;
           $project->desc = $request->desc;
           $project->project_tech = $request->tech;
           $project->project_start_date = date('Y-m-d H:i:s', strtotime($request->sdate));
           $project->project_end_date = date('Y-m-d H:i:s', strtotime($request->edate));
           $project->save();
           return redirect()->route('taskmanagment.index')->with('success','project update succesfully ');
    }

    public function destroy(Request $request){
        // $request->validate([

        // ])
    }


    public function view(Request $request){
        return view('taskmanagment.view');
    }

}
