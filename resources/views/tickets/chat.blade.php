@extends($layout)
@section('contents')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Chat for Ticket: {{ $ticket->title }}</h5>
                    </div>
                    <div class="card-body" style="height: 70vh; display: flex; flex-direction: column;">
                        <div id="messages" class="chat-messages flex-grow-1 overflow-auto mb-3"
                            style="height: calc(100% - 100px);">
                            @foreach ($messages as $message)
                                <div class="message mb-3 @if ($message->user_id === Auth::id()) text-right @endif">
                                    <div
                                        class="@if ($message->user_id === Auth::id()) bg-primary text-white @else bg-light @endif d-inline-block p-2 rounded">
                                        <strong>{{ $message->user->name }}:</strong>
                                        <p class="mb-0">{{ $message->message }}</p>
                                    </div>
                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('tickets.chat.store', $ticket) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="input-group">
                                <textarea name="message" class="form-control" rows="2" required placeholder="Type your message here..."></textarea>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<!-- Load Pusher -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Load Laravel Echo without integrity and crossorigin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.iife.min.js"></script>

<script>
    const ticketId = {{ $ticket->id }};
    // Initialize Pusher with your app key and cluster
    Pusher.logToConsole = true;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true
    });

    // Listen to the chat channel for real-time messages
    Echo.private(`chat.${ticketId}`)
    .listen('MessageSent', (event) => {
        const userName = event.message.user ? event.message.user.name : 'User';
        const messageHtml = `
            <div class="message mb-3 ${event.message.user_id === {{ Auth::id() }} ? 'text-right' : ''}">
                <div class="${event.message.user_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-light'} d-inline-block p-2 rounded">
                    <strong>${userName}:</strong>
                    <p class="mb-0">${event.message.message}</p>
                </div>
                <small class="text-muted">${new Date(event.message.created_at).toLocaleTimeString()}</small>
            </div>`;
        document.querySelector('.chat-messages').innerHTML += messageHtml;
    });

</script>

<style>
    .chat-messages {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }

    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: #888;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
