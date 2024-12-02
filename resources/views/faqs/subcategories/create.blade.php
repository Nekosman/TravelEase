@extends(Auth::user()->role === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'Create Category')

@section('contents')
    <link rel="stylesheet" href="{{ asset('assets/css/FormInput.css') }}">

    <div class="form-wrapper"> <!-- Wrapper untuk mengontrol layout secara fleksibel -->
        <div class="form-container">
            <div class="card shadow-lg"> <!-- Tambahkan shadow -->
                <div class="card-header text-white" style="background-color: #366389;">Create Category</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('faqSubCategory.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label">Name</label>
                            <input type="text" class="form-control @error('question') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faq_category_id" class="form-label">Category</label>
                            <select class="form-select @error('faq_category_id') is-invalid @enderror" id="faq_category_id"
                                name="faq_category_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($faqcategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                                @error('faq_category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn text-white" style="background-color: #366389;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
