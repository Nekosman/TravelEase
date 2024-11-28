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
                            <a href="{{ route('faqCategory.index') }}" class="btn btn-success btn-sm me-2">Create Category</a>
                            <a href="{{ route('faq.create') }}" class="btn btn-info btn-sm">Create FAQ</a>
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
                                    <th>Category</th>
                                    <th>Subcategory</th> <!-- Kolom tambahan untuk Subcategory -->
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
                                            @if ($faq->category)
                                                <span class="badge bg-secondary">{{ $faq->category->name }}</span>
                                            @else
                                                <span class="badge bg-warning">No Category</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($faq->subcategory)
                                                <span class="badge bg-info">{{ $faq->subcategory->name }}</span>
                                            @else
                                                <span class="badge bg-warning">No Subcategory</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#faqDetailModal{{ $faq->id }}">View</button>
                                            <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#faqDeleteModal{{ $faq->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Modal for FAQ Details -->
                                    <div class="modal fade" id="faqDetailModal{{ $faq->id }}" tabindex="-1" aria-labelledby="faqDetailModalLabel{{ $faq->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="faqDetailModalLabel{{ $faq->id }}">FAQ Details</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID:</strong> {{ $faq->id }}</p>
                                                    <p><strong>Question:</strong> {{ $faq->question }}</p>
                                                    <p><strong>Answer:</strong> {{ $faq->answer }}</p>
                                                    <p><strong>Category:</strong>
                                                        @if ($faq->category)
                                                            {{ $faq->category->name }}
                                                        @else
                                                            No Category
                                                        @endif
                                                    </p>
                                                    <p><strong>Subcategory:</strong>
                                                        @if ($faq->subcategory)
                                                            {{ $faq->subcategory->name }}
                                                        @else
                                                            No Subcategory
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="faqDeleteModal{{ $faq->id }}" tabindex="-1" aria-labelledby="faqDeleteModalLabel{{ $faq->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #366389;">
                                                    <h5 class="modal-title text-white" id="faqDeleteModalLabel{{ $faq->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this FAQ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST">
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
