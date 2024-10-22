@extends( $layout)
@section('contents')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Chat for Ticket: {{ $ticket->title }}</h5>
                </div>
                <div class="card-body" style="height: 70vh; display: flex; flex-direction: column;">
                    <div class="chat-messages flex-grow-1 overflow-auto mb-3" style="height: calc(100% - 100px);">
                        @foreach($messages as $message)
                            <div class="message mb-3 @if($message->user_id === Auth::id()) text-right @endif">
                                <div class="@if($message->user_id === Auth::id()) bg-primary text-white @else bg-light @endif d-inline-block p-2 rounded">
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
@push('styles')
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
@endpush