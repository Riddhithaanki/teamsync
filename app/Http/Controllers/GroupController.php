<?php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Group_user;
use App\Models\Groupschat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Events\MessageSent;
use GrahamCampbell\ResultType\Success;

class GroupController extends Controller
{
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the logged-in user
        $groups = Group::get();
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

    public function groupschat($id) {
        
        $id = Crypt::decrypt($id);
       
        
        $sender_id = Auth::user();
       // dd($id,$sender_id);
        $group = new Group();
        $groups_id = Group::find($id);
        //dd($id,$sender_id,$groups_id);
        $groupschat = new Groupschat();
       
        $groupschat = Groupschat::where(function ($query) use ($sender_id, $groups_id) {
            $query->where('sender_id', $sender_id->id)
                ->where('groups_id', $groups_id->id);
        })
            ->orWhere(function ($query) use ($sender_id, $groups_id) {
                $query->where('groups_id', $groups_id->id)
                    ->where('sender_id', $sender_id->id);
            })
            ->orderBy('created_at', 'desc') // Optional: Order messages by time
            ->get();

        
        return view ('groups.groupchat',compact('groupschat','groups_id'));
    }

    public function send(Request $request, $id)
    {   $id = crypt::decrypt($id);
        
        $sender_id = Auth::user()->id;
        $groups_id = Group::find($id);
        $message = new Groupschat();
                   
        $message->sender_id = Auth::user()->id;
        $message->groups_id = $groups_id->id;;
        $message->body = $request->message;
        $message->save();
        
        $chatmessages = Groupschat::where(function ($query) use ($sender_id, $groups_id) {
            $query->where('sender_id', $sender_id)
                ->where('groups_id', $groups_id);
        })
            ->orWhere(function ($query) use ($sender_id, $groups_id) {
                $query->where('sender_id', $groups_id)
                    ->where('groups_id', $sender_id);
            })
            ->orderBy('created_at', 'desc') // Optional: Order messages by time
            ->get();


        $groupschat = Groupschat::get($message->body);
        $groups = Group::get($id);
            dd($groups);
        //    return redirect()->back();
        return view('groups.groupchat', compact('message','chatmessages','groupschat','groups'));
    }

    public function delete($id){
       
        $id = crypt::decrypt($id);
        
        $groups = Group::findOrFail($id);
        $chats = Groupschat::where('groups_id', $groups->id)->get();
        //dd($id,$groups,$chats);
        $chats->each->delete();
        $groups->delete();

        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the logged-in user
        $groups = Group::get();
        return redirect()->route('groups.create')->with('success', 'Group Deleted successfully!');
    }

}
