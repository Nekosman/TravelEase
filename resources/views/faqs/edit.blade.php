@extends(Auth::user()->role === 'officer' ? 'layouts.officer.sidebar' : 'layouts.admin.sidebar')

@section('title', 'Edit Category')

@section('contents')
    <link rel="stylesheet" href="{{ asset('assets/css/FormInput.css') }}">

    <div class="form-wrapper"> <!-- Wrapper untuk mengontrol layout secara fleksibel -->
        <div class="form-container">
            <div class="card shadow-lg"> <!-- Tambahkan shadow -->
                <div class="card-header text-white" style="background-color: #366389;">Create Ticket</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('faq.update', $faq->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control @error('question') is-invalid @enderror" id="question"
                                name="question" value="{{ old('question', $faq->question) }}">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="answer" class="form-label">Description</label>
                            <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer"
                                rows="4">{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')
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
