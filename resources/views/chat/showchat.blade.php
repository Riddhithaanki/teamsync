@extends('adminlte::page')

@section('title', 'Chat Management')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chat Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card direct-chat direct-chat-primary shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-comments mr-1"></i> {{$reciverUser->name}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body chat-body p-3" style="background-color: #f8f9fa;">
                    <div class="direct-chat-messages" style="height: 400px; overflow-y: auto;">
                        @foreach($chatmessages as $message)
                            <div class="direct-chat-msg {{ $message->from_id == auth()->user()->id ? 'right' : '' }}">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name {{ $message->from_id == auth()->user()->id ? 'float-right' : 'float-left' }}">
                                        {{ $message->from_id == auth()->user()->id ? 'Me' : $message->user->name ?? 'User ' }}
                                    </span>
                                    <span class="direct-chat-timestamp {{ $message->from_id == auth()->user()->id ? 'float-left' : 'float-right' }}">
                                        {{ $message->created_at->format('H:i') }}
                                       
                                    </span>
                                </div>
                                <img class="direct-chat-img" src="{{ $message->user->avatar ?? "https://images.unsplash.com/photo-1639149888905-fb39731f2e6c?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" }}" alt="User Image">
                                <div class="chat-message p-3 rounded shadow-sm {{ $message->from_id == auth()->user()->id ? 'bg-primary text-white' : 'bg-light' }}">
                                    {{ $message->body }}
                                    @if($message->from_id == auth()->user()->id)
                                        
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="card-footer">
                    <form action="{{ route('chat.send', ['id' => request()->route('id')]) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type your message..." class="form-control rounded-left" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary rounded-right">
                                    <i class="fas fa-paper-plane"></i> Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .direct-chat-messages {
    padding: 15px;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.direct-chat-msg {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    opacity: 0;
    animation: slideIn 0.5s ease-in-out forwards;
}

@keyframes slideIn {
    from { transform: translateX(-10px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.direct-chat-msg.right {
    align-items: flex-end;
    animation: slideInRight 0.5s ease-in-out forwards;
}

@keyframes slideInRight {
    from { transform: translateX(10px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.direct-chat-img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    object-fit: cover;
    border: 2px solid #ddd;
    padding: 2px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.chat-message {
    position: relative;
    padding: 15px;
    border-radius: 15px;
    max-width: 70%;
    word-wrap: break-word;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

.right .chat-message {
    background: linear-gradient(45deg, #007bff, #00c6ff);
    color: white;
    align-self: flex-end;
    box-shadow: 0px 0px 15px rgba(0, 123, 255, 0.5);
}

.chat-message:hover {
    transform: scale(1.05);
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}

.edit-icon {
    display: none;
    cursor: pointer;
    font-size: 14px;
    margin-left: 5px;
    transition: transform 0.2s ease-in-out;
}

.chat-message:hover .edit-icon {
    display: inline;
    transform: scale(1.2);
}

.input-group .btn-primary {
    transition: all 0.3s ease-in-out;
}

.input-group .btn-primary:hover {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    transform: scale(1.1);
    box-shadow: 0px 4px 15px rgba(255, 65, 108, 0.5);
}

</style>
@stop
