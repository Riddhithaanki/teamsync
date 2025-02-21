<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        return view('employees.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,hr,tech_lead,developer',
            'salary' => 'nullable|numeric',
            'joining_date' => 'required|date',
        ]);


        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('password');
        $user->role = $request->role;
        $user->save();

        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->joining_date = Carbon::parse($request->joining_date)->format('Y-m-d');
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        // $employee = Employee::findOrFail($id);
        $employeeData = Employee::with('user')->where('id', $id)->first();
        return view('employees.edit', compact('employeeData'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,hr,tech_lead,developer',
            'salary' => 'nullable|numeric',
            'joining_date' => 'required|date',
        ]);


        $employee = Employee::findOrFail($request->id);
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->joining_date = Carbon::parse($request->joining_date)->format('Y-m-d');
        $employee->save();

        if($employee){
            $user = User::findOrFail($employee->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
        }else{
            return redirect()->back()->with('error', 'Employee not found!');
        }
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $employee = Employee::findOrFail($id);
        $user = User::where('id', $employee->user_id)->first();
        $user->delete();
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
