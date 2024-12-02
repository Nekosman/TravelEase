@extends('layouts.admin.sidebar')

@section('title', 'Ticketing')


@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #366389;">
                        <h4 class="mb-0">User List </h4>
                        <div class="float-end">
                            <a href="{{ route('user.list', ['filter' => 'all']) }}" class="btn btn-success btn-sm">All
                                Users</a>
                            <a href="{{ route('user.list', ['filter' => 'admin']) }}" class="btn btn-danger btn-sm">Admin
                                Only</a>
                            <a href="{{ route('user.list', ['filter' => 'officer']) }}"
                                class="btn btn-warning btn-sm">Officer Only</a>
                            <a href="{{ route('user.list', ['filter' => 'user']) }}" class="btn btn-primary btn-sm">User
                                Only</a>
                            <a href="{{ route('user.createOfficer') }}" class="btn btn-info btn-sm">Create Officer</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>is Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($UserList as $userlist)
                                    <tr>
                                        <td>{{ $userlist->id }}</td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($userlist->profile_image)
                                                        <img src="{{ asset($userlist->profile_image) }}"
                                                            class="avatar me-3 border-radius-lg"
                                                            style="width: 24px; height: 24px; object-fit: cover; border-radius: 50%;"
                                                            alt="{{ $userlist->profile_image }}">
                                                    @else
                                                        <span>No Image</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $userlist->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $userlist->email }}</td>
                                        <td>{{ $userlist->type }}</td>
                                        <td>{{ getApprovalStatus($userlist->is_approved) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $userlist->id }}">Delete</button>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#approval-toggle{{ $userlist->id }}">Change Aprroved</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal{{ $userlist->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteModalLabel{{ $userlist->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white"
                                                        id="deleteModalLabel{{ $userlist->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close text-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this ticket?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('user.destroy', $userlist->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="approval-toggle{{ $userlist->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="approval-toggleLabel{{ $userlist->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white"
                                                        id="approval-toggleLabel{{ $userlist->id }}">Confirm Change Approved</h5>
                                                    <button type="button" class="btn-close text-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this ticket?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('toggle.approval', $userlist->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('post')
                                                        <button type="submit" class="btn btn-danger">Yes</button>
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
