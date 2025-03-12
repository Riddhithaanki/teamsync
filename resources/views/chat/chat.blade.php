<div id="chat-box">
    @foreach ($messages as $message)
        <p>{{ $message->message }}</p>
    @endforeach
</div>

<form id="chat-form">
    @csrf
    <input type="text" id="message-input" placeholder="Type a message">
    <button type="submit">Send</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#chat-form").submit(function(e) {
        e.preventDefault();
        
        let message = $("#message-input").val();

        $.ajax({
            url: "{{ route('send-message') }}",
            type: "POST",
            data: {
                message: message,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $("#message-input").val(""); // Clear input
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });
});
</script>
