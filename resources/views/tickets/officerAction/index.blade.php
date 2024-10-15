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
                                    </td>
                                </tr>

                                <!-- Modal for Ticket Details -->
                                <div class="modal fade" id="ticketDetailModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketDetailModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #366389;">
                                                <h5 class="modal-title text-white" id="ticketDetailModalLabel{{ $ticket->id }}">Ticket Details</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
                                                <p><strong>Status:</strong> {{ $ticket->status }}</p>
                                                <p><strong>Officer:</strong> 
                                                    @if($ticket->officer)
                                                        {{ $ticket->officer->name }}
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #366389;">
                                                <h5 class="modal-title text-white" id="deleteModalLabel{{ $ticket->id }}">Confirm Delete</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this ticket?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
