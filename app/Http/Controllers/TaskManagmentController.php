<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Laravel\Pail\ValueObjects\Origin\Console;

class TaskManagmentController extends Controller
{
    public function index()
    {
        $projects = Project::get();

        return view('taskmanagment.index', compact('projects')); // Make sure this view exists

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
        } // This will stop execution and show validation errors

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

    public function edit($id)
    {
        $projects = Project::get();
        $id = Crypt::decrypt($id);
        // $employee = Employee::findOrFail($id);
        $project = Project::where('id', $id)->first();
        return view('taskmanagment.edit', compact('project'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'tech' => 'nullable',
            'sdate' => 'required',
            'edate' => 'required'
        ]);
        $project = Project::findOrFail($request->id);
        $project->project_name = $request->name;
        $project->project_desc = $request->desc;
        $project->project_tech = $request->tech;
        $project->project_start_date = date('Y-m-d H:i:s', strtotime($request->sdate));
        $project->project_end_date = date('Y-m-d H:i:s', strtotime($request->edate));
        $project->save();

        return redirect()->route('taskmanagment.index')->with('success', 'project update succesfully ');
    }

    public function destroy($id)
    {
        $project = Project::whereId($id)->first();
        $project->delete();
        return redirect('/taskmanagment.index');
    }

    public function view($id)
    {
        //dd($eid);
        $id = Crypt::decrypt($id);
        $project = Project::findOrFail($id);
        $projectUsers = ProjectUser::where('project_id', $id)->get();
        $tasks = Task::where('task_project_id', $id)->get();
        $users = [];
        foreach ($projectUsers as $projectUser) {
            $user = User::where('id', $projectUser->user_id)->first();
            if ($user) {
                $users[] = $user;
            }
        }
        // dd($users);
        return view('taskmanagment.view', compact('project', 'users', 'tasks'));
    }

    public function assignuser($id)
    {
        // dd($id);
        $project = Project::where('id', $id)->first();
        $users = User::where('role', '!=', 'admin')->get();
        // dd($users,$project);
        // return redirect('taskmanagment.assignuserview')->with('success','User Added Successfully ');
        return view('taskmanagment.assignuser', compact('project', 'users'));
        //return $assignuser;
    }

    public function assignuserview(Request $request)
    {
        // dd($request->all());
        $projectUser = new ProjectUser();
        $projectUser->user_id = $request->assignuser;
        $projectUser->project_id = $request->project_id;
        $projectUser->save();

        return redirect()->route('taskmanagment.index')->with('success', 'User Assigned Success');
    }

    public function createtask($id)
    {
        $project = Project::where('id', $id)->first();
        $users = User::all();
        return view('taskmanagment.createtask', compact('project', 'users'));
    }

    public function savetask(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            // 'createdby' => 'nullable',
            'priority' => 'required',
            //'status' => 'required'
        ]);

        // dd($request->all());
        if ($errors = $request->session()->get('errors')) {
            dd($request->session()->get('errors'));
        } // This will stop execution and show validation errors
        try {


            if ($request->status == "pending") {
                $status = 0;
            } elseif ($request->status == "completed") {
                $status = 1;
            } elseif ($request->status == "working") {
                $status = 2;
            } elseif ($request->status == "overdue") {
                $status = 3;
            } else {
                $status = 0;
            }

            $task = new Task();
            //$task->created_by_id = Auth::id(); // Store the logged-in user's ID
            $task->task_name = $request->name;
            $task->task_desc = $request->desc;
            $task->task_status = $status;
            $task->task_priority = $request->priority;
            $task->task_created_by = Auth::id();
            $task->task_project_id = $request->id;
            $task->task_due_date = $request->due_date;
            $task->save();

            return redirect()->route('taskmanagment.index')->with('success', 'Task added successfully');
        } catch (\Exception $e) {
            // return back()->withErrors('Failed to save project. Error: ' . $e->getMessage());
            return redirect()->route('taskmanagment.index')->with('success', 'Failed to add task . Error: ' . $e->getMessage());
        }
    }
    // public function showtask(){
    //     $project = Project::all();
    //     dd($project->id);
    //     $user = User::all();
    //     $id = $project->project_id;
    //     $tasks = Task::where('task_project_id', $id)->get();
    //     return view('taskmanagment.showtask' ,compact('project','user'));
    // }

    public function showtask($id)
    {
        $project = Project::find($id); // This is a collection
        $tasks = Task::where('task_project_id', $project->id)->latest()->get();
        return view('taskmanagment.showtask', compact('tasks', 'project'));
    }
    public function viewtask(Request $request)
    {
        $projects = Project::where('id', $request->project)->latest()->first();
        $tasks = Task::where('task_project_id', $request->project)->latest()->get();
    }

    public function edittask(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        //$projects = Project::with('tasks')->where('id',$id)->first();
        $project = Project::find($id);

        $task = Task::where('task_id', $id)->latest()->first();

        return view('taskmanagment.edittask', compact('task'));
    }

    public function updateTask(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tasks,task_id',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'priority' => 'required|integer',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        try {
            // Fetch the task using `task_id`
            $task = Task::where('task_id', $request->id)->firstOrFail();

            // Map status to numeric values
            $statusMap = [
                'pending' => 0,
                'completed' => 1,
                'working' => 2,
                'overdue' => 3,
            ];
            $status = $statusMap[$request->status] ?? 0;

            // Update task fields
            $task->update([
                'task_name' => $request->name,
                'task_desc' => $request->desc,
                'task_priority' => $request->priority,
                'task_status' => $status,
                'task_due_date' => $request->due_date,
                'updated_at' => now(), // Ensure updated_at is refreshed
            ]);

            return redirect()->route('taskmanagment.showtask',$task->task_project_id)->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Failed to update task: ' . $e->getMessage());
        }
    }


    public function deletetask(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $project = Project::findOrFail($id);
        $tasks = Task::where('id', $project->task_id)->first();
        $tasks->delete();

        return redirect()->route('taskmanagmnet.showtask')->with('success', 'Task deleted successfully!');
    }
}
