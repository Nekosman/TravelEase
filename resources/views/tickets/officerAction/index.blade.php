@extends(Auth::user()->type === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'List Tickets')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header text-white" style="background-color: #366389;">
                    <h4 class="mb-0">Tickets List</h4>
                    <div class="float-end">
                        <a href="{{ route('ticket', ['filter' => 'all']) }}" class="btn btn-success btn-sm">All Tickets</a>
                        <a href="{{ route('ticket', ['filter' => 'officer_empty']) }}" class="btn btn-danger btn-sm">Empty Officer</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-hover table-bordered">
                        <thead class="text-white" style="background-color: #366389;">
                            <tr>
                                <th>id</th>
                                <th>Ticket_no</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>officer name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ticket->ticket_no }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>
                                        @if($ticket->officer)
                                            {{ $ticket->officer->name }}
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->status == 'pending' && $ticket->officer_id === null)
                                            <a href="{{ route('officer.showAcceptForm', $ticket->id) }}" class="btn btn-info btn-sm">Accept</a>
                                        @elseif ($ticket->status == 'accepted' && $ticket->officer_id === Auth::id())
                                            <a href="{{ route('tickets.chat', $ticket->id) }}" class="btn btn-primary btn-sm">Chat</a>
                                        @else
                                            No Action
                                        @endif

                                        <!-- Move to Trash button -->
                                        <form action="{{ route('ticket.moveToTrash', $ticket->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Move to Trash</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Bootstrap and jQuery for Modal functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
