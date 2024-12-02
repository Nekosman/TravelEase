@extends(Auth::user()->role === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'Create Category')

@section('contents')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/FormInput.css') }}"> --}}

    <div class="form-wrapper"> <!-- Wrapper untuk mengontrol layout secara fleksibel -->
        <div class="form-container">
            <div class="card shadow-lg"> <!-- Tambahkan shadow -->
                <div class="card-header text-white" style="background-color: #366389;">Create Category</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('faq.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label">question</label>
                            <input type="text" class="form-control @error('question') is-invalid @enderror"
                                id="question" name="question" value="{{ old('question') }}">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="answer" class="form-label">answer</label>
                            <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="4">{{ old('answer') }}</textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($faqcategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label">SubCategory</label>
                            <select class="form-select @error('subcategory_id') is-invalid @enderror" id="subcategory_id"
                                name="subcategory_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ old('subcategory_id') == $category->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                                @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @error('subcategory_id')
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#faq_categories').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>

@endsection