@extends(Auth::user()->type === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'FAQ List ')

<style>
    .table-spacing {
        margin-top: 30px;
        /* Sesuaikan nilai margin sesuai kebutuhan */
    }
</style>


@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #366389;">
                        <h4 class="mb-0">FAQS Categories</h4>
                        <div class="float-end">
                            <a href="{{ route('faqCategory.create') }}" class="btn btn-light btn-sm">Create Category</a>
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
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqCategory as $faqcategory)
                                    <tr>
                                        <td>{{ $faqcategory->id }}</td>
                                        <td>{{ $faqcategory->name }}</td>
                                        <td>{{ $faqcategory->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#faqcategoryDetailModal{{ $faqcategory->id }}">View</button>
                                            <a href="{{ route('faqCategory.edit', $faqcategory->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#faqcategoryDeleteModal{{ $faqcategory->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Modal for Ticket Details -->
                                    <div class="modal fade" id="faqcategoryDetailModal{{ $faqcategory->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="faqcategoryDetailModalLabel{{ $faqcategory->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white"
                                                        id="faqcategoryDetailModalLabel{{ $faqcategory->id }}">FAQ Category
                                                        Details</h5>
                                                    <button type="button" class="btn-close text-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID:</strong> {{ $faqcategory->id }}</p>
                                                    <p><strong>Name Category:</strong> {{ $faqcategory->name }}</p>
                                                    <p><strong>Description:</strong> {{ $faqcategory->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="faqcategoryDeleteModal{{ $faqcategory->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="faqcategoryDeleteModalLabel{{ $faqcategory->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white"
                                                        id="faqcategoryDeleteModalLabel{{ $faqcategory->id }}">Confirm
                                                        Delete</h5>
                                                    <button type="button" class="btn-close text-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this ticket?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('faqCategory.destroy', $faqcategory->id) }}"
                                                        method="POST" style="display: inline;">
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
