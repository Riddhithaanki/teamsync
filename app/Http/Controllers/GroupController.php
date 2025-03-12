<?php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Group_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the logged-in user
        $groups = Group::where('id',Auth::id())->get();
        return view('groups.create', compact('users','groups'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);
        $user = new User();
        $user->id = $request->id;
        $id = Auth::id();
       // dd($id);

        $group = new Group();
        $group->name = $request->name;
        $group->created_by = Auth::id();
        
        $member = new Group_user();
        $member->group_id = $group->id;
        $member->user_id = $user->id;
        // $group = Group::create([
        //     'name' => $request->name,
        //     'created_by' => Auth::user(),
        // ]);
        $group->save();
        $group->users()->attach($request->users); // Attach selected users

        return redirect()->route('groups.create')->with('success', 'Group created successfully!');
    }
}
