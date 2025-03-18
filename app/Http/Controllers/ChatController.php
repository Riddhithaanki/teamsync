<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChMessage;
use  Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Events\MessageSent;


class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        //dd($users);
        $chatmessages = ChMessage::get();
        return view("chat.index", compact('users', 'chatmessages'));
    }

    // public function chats()
    // {
    //     $users = User::get();
    //     dd($users);
    // }

    public function showchat($id)
    {
        $id = Crypt::decrypt($id);
        $reciverUser = User::find($id);
        $senderUser = Auth::user();
        
        $chatmessages = ChMessage::where(function ($query) use ($senderUser, $reciverUser) {
            $query->where('from_id', $senderUser->id)
                ->where('to_id', $reciverUser->id);
        })
            ->orWhere(function ($query) use ($senderUser, $reciverUser) {
                $query->where('from_id', $reciverUser->id)
                    ->where('to_id', $senderUser->id);
            })
            ->orderBy('created_at', 'desc') // Optional: Order messages by time
            ->get();



        return view("chat.showchat", compact('chatmessages', 'senderUser', 'id', 'reciverUser'));
    }

    public function send(Request $request, $id)
    {   $id = crypt::decrypt($id);
        
        $senderUser = Auth::user()->id;
        $message = new ChMessage();
                   
        $message->from_id = Auth::user()->id;
        $message->to_id = $id;
        $message->body = $request->message;
        $message->save();
        
        $chatmessages = ChMessage::where(function ($query) use ($senderUser, $id) {
            $query->where('from_id', $senderUser)
                ->where('to_id', $id);
        })
            ->orWhere(function ($query) use ($senderUser, $id) {
                $query->where('from_id', $id)
                    ->where('to_id', $senderUser);
            })
            ->orderBy('created_at', 'desc') // Optional: Order messages by time
            ->get();
        //    return redirect()->back();
        return view('chat.showchat', compact('message','chatmessages'));
    }

    public function editchat()
    {
        return view('chat.edit');
    }

    public function sendMessage(Request $request)
{
    $message = $request->input('message');
    $user = auth()->user();

    broadcast(new MessageSent($message, $user))->toOthers();

    return response()->json(['success' => true]);
    }


}
