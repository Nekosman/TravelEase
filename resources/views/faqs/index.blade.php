@extends(Auth::user()->type === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'FAQ List  ')


@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #366389;">
                        <h4 class="mb-0">FAQS</h4>
                        <div class="float-end">
                            <a href="{{ route('faq.create') }}" class="btn btn-light btn-sm">Create Category</a>
                        </div>
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

                        <table class="table table-hover table-bordered">
                            <thead class="text-white" style="background-color: #366389;">
                                <tr>
                                    <th>ID</th>
                                    <th>FAQ Question</th>
                                    <th>FAQ Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ticketDetailModal{{ $faq->id }}">View</button>
                                            <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $faq->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Modal for Ticket Details -->
                                    <div class="modal fade" id="ticketDetailModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketDetailModalLabel{{ $faq->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="ticketDetailModalLabel{{ $faq->id }}">FAQ Details</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID:</strong> {{ $faq->id }}</p>
                                                    <p><strong>Name Category:</strong> {{ $faq->question }}</p>
                                                    <p><strong>Description:</strong> {{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $faq->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="deleteModalLabel{{ $faq->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this ticket?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display: inline;">
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
