<h1> chat system </h1>
<!-- chat.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Module</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .chat-container {
            height: calc(100vh - 180px);
        }
        .message-input {
            resize: none;
        }
        .message-bubble {
            max-width: 75%;
            word-break: break-word;
        }
        .message-time {
            font-size: 0.7rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Chat Header -->
            <div class="bg-blue-600 text-white px-4 py-3 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white overflow-hidden mr-3">
                        <h4> img</h4>
                        <img src="https://iconscout.com/free-icon/avatar-373_456325" alt="User Avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-semibold"></h3>
                        <p class="text-xs text-blue-200">
                        {{-- @if(isset($receiver->is_online) && $receiver->is_online) --}}
                                <span class="inline-block w-2 h-2 bg-green-400 rounded-full mr-1"></span> Online
                            {{-- @else --}}
                                <span class="inline-block w-2 h-2 bg-gray-400 rounded-full mr-1"></span> Offline
                            {{-- @endif --}}
                        </p>
                    </div>
                </div>
                <div>
                    <button class="text-white hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="chat-container overflow-y-auto p-4">
                {{-- @forelse($messages ?? [] as $message) --}}
                     <div class="mb-4 flex >{{--{{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}"> --}}
                        {{-- @if($message->sender_id != auth()->id()) --}}
                            <div class="w-8 h-8 rounded-full overflow-hidden mr-2 flex-shrink-0">
                                <img src="https://iconscout.com/free-icon/avatar-373_456325" alt="Sender Avatar" class="w-full h-full object-cover">
                            </div>
                        {{-- @endif --}}
                        
                         <div class="message-bubble >{{--{{ $message->sender_id == auth()->id() ? 'bg-blue-600 text-white rounded-tl-lg rounded-tr-lg rounded-bl-lg' : 'bg-gray-200 text-gray-800 rounded-tl-lg rounded-tr-lg rounded-br-lg' }} px-4 py-2 shadow-sm"> --}}
                            {{-- <p>{{ $message->content }}</p> --}}
                            {{-- <span class="message-time block {{ $message->sender_id == auth()->id() ? 'text-blue-200' : 'text-gray-500' }} mt-1"> --}}
                                {{-- {{ $message->created_at->format('h:i A') }} --}}
                                {{-- @if($message->sender_id == auth()->id()) --}}
                                    {{-- @if($message->is_read) --}}
                                        <i class="fas fa-check-double ml-1"></i>
                                    {{-- @else --}}
                                        <i class="fas fa-check ml-1"></i>
                                    {{-- @endif --}}
                                {{-- @endif --}}
                            </span>
                        </div>
                        
                        {{-- @if($message->sender_id == auth()->id()) --}}
                            <div class="w-8 h-8 rounded-full overflow-hidden ml-2 flex-shrink-0">
                                <img src="" alt="Your Avatar" class="w-full h-full object-cover">
                            </div>
                        {{-- @endif --}}
                    </div>
                {{-- @empty --}}
                    <div class="flex justify-center items-center h-full">
                        <p class="text-gray-500">No messages yet. Start the conversation!</p>
                    </div>
                {{-- @endforelse --}}
            </div>
            
            <!-- Message Input -->
            <div class="border-t border-gray-200 p-4">
                <form id="message-form" class="flex items-end">
                    <div class="flex-1 mr-2">
                        <textarea id="message-input" class="message-input w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message..." rows="1"></textarea>
                    </div>
                    <div class="flex space-x-2">
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 rounded-full w-10 h-10 flex items-center justify-center focus:outline-none">
                            <i class="fas fa-paperclip text-gray-600"></i>
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 rounded-full w-10 h-10 flex items-center justify-center focus:outline-none">
                            <i class="fas fa-paper-plane text-white"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Auto-resize textarea
            $('#message-input').on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            
            // Scroll to bottom of chat
            function scrollToBottom() {
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
            
            scrollToBottom();
            
            // Form submission
            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                
                const messageInput = $('#message-input');
                const message = messageInput.val().trim();
                
                if (message !== '') {
                    // Here you would normally send an AJAX request to your backend
                    // For demo purposes, we'll add the message directly to the chat
                    const currentTime = new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                    
                    const newMessage = `
                        <div class="mb-4 flex justify-end">
                            <div class="message-bubble bg-blue-600 text-white rounded-tl-lg rounded-tr-lg rounded-bl-lg px-4 py-2 shadow-sm">
                                <p>${message}</p>
                                <span class="message-time block text-blue-200 mt-1">
                                    ${currentTime}
                                    <i class="fas fa-check ml-1"></i>
                                </span>
                            </div>
                            <div class="w-8 h-8 rounded-full overflow-hidden ml-2 flex-shrink-0">
                                <img src="/images/default-avatar.png" alt="Your Avatar" class="w-full h-full object-cover">
                            </div>
                        </div>
                    `;
                    
                    $('#chat-messages').append(newMessage);
                    messageInput.val('').css('height', 'auto');
                    scrollToBottom();
                }
            });
        });
    </script>
</body>
</html>