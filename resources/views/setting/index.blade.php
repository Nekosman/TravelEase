@extends('layouts.user.sidebar')

@section('contents')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<style>
    .container {
        background-color: #366389;
        padding: 20px;
        border-radius: 8px;
    }

    h2 {
        color: white;
    }

    .alert-success {
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
        color: white; /* Warna teks label diubah menjadi putih */
    }

    .form-control {
        border: 1px solid #ced4da;
    }

    .btn-primary {
        background-color: #007bff;
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <h2>Pengaturan Akun</h2>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('setting.update') }}" method="POST">
        @csrf
        <!-- Update Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
        </div>

        <!-- Update Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>
</div>
@endsection
