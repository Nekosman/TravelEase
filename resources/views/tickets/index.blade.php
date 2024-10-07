@extends('layouts.user.sidebar')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
<<<<<<< HEAD
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tickets</h5>
                        <div>
                            <a href="{{ route('ticket.create') }}" class="btn btn-primary">Create Ticket</a>
                            <a href="{{ route('ticket.index', ['filter' => 'all']) }}" class="btn btn-success">All Tickets</a>
                            <a href="{{ route('ticket.index', ['filter' => 'officer_empty']) }}" class="btn btn-danger">Empty Officer</a>
                        </div>
=======
                <div class="card">
                    <div class="card-header">
                        Tickets
                        <a href="{{ route('ticket.create') }}" class="btn btn-primary float-end">Create Ticket</a>
                        <a href="{{ route('user.ticket', ['filter' => 'all']) }}" class="btn btn-success">All Tickets</a>
                        <a href="{{ route('user.ticket', ['filter' => 'officer_empty']) }}" class="btn btn-danger">Empty Officer</a>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ticket No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Status</th>
<<<<<<< HEAD
                                    <th>Chat</th>
=======
                                    <th>Category</th>
                                    <th>chat</th>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->ticket_no }}</td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td>{{ $ticket->priority }}</td>
                                        <td>{{ $ticket->status }}</td>
                                        <td>{{ $ticket->category->name_category }}</td>
                                        <td>
                                            @if ($ticket->status === 'scheduled')
<<<<<<< HEAD
                                                <a href="{{ route('chat.show', $ticket->id) }}" class="btn btn-primary btn-sm">Go to Chat</a>
=======
                                                <a href="{{ route('chat.show', $ticket->id) }}" class="btn btn-primary">Go to Chat</a>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                                            @else
                                                <span class="btn btn-secondary btn-sm disabled">Chat Not Available</span>
                                            @endif
                                        </td>
                                        <td>
<<<<<<< HEAD
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#ticketDetailModal{{ $ticket->id }}">View</button>
                                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $ticket->id }}">Delete</button>
=======
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#ticketDetailModal{{ $ticket->id }}">View</button>
                                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $ticket->id }}">Delete</button>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for Ticket Details -->
                                    <div class="modal fade" id="ticketDetailModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketDetailModalLabel{{ $ticket->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
<<<<<<< HEAD
                                                    <h5 class="modal-title" id="ticketDetailModalLabel{{ $ticket->id }}">Ticket Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
=======
                                                    <h5 class="modal-title" id="ticketDetailModalLabel{{ $ticket->id }}">
                                                        Ticket Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
                                                    <p><strong>Status:</strong> {{ $ticket->status }}</p>
<<<<<<< HEAD
                                                    <p><strong>Guru yang Mengambil:</strong> {{ $ticket->guru ? $ticket->guru->name : 'Tidak ada' }}</p>
=======
                                                    <p><strong>Category:</strong>
                                                        {{ $ticket->category->name_category }}
                                                    </p>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $ticket->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
<<<<<<< HEAD
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $ticket->id }}">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
=======
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $ticket->id }}">
                                                        Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
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
<<<<<<< HEAD

                        {{-- Pagination (commented out) --}}
                        {{-- <div class="d-flex justify-content-center">
                            {{ $tickets->links() }}
                        </div> --}}
=======
>>>>>>> 7775111153b93c9a04e9eceb423c05d07c80ed91
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap and jQuery for Modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
