@extends('layouts.user.sidebar')

@section('contents')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<style>
    .container {
        background: linear-gradient(to bottom, #366389 18%, white 18%);
        padding: 40px 20px; /* Tambahkan padding lebih besar untuk estetika */
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4); /* Shadow untuk kedalaman */
        max-width: 600px; /* Membatasi lebar maksimal untuk fokus yang lebih baik */
        margin: 0 auto; /* Memusatkan elemen container */
    }

    h2 {
        color: white;
        text-align: center; /* Buat judul berada di tengah */
        font-size: 24px; /* Ukuran teks lebih besar untuk penekanan */
        margin-bottom: 20px; /* Beri jarak di bawah judul */
    }

    .alert-success {
        font-weight: bold;
        color: black;
        background-color: #d4edda; /* Tambahkan background hijau muda untuk notifikasi sukses */
        padding: 10px;
        border-radius: 5px;
        text-align: center; /* Pusatkan teks notifikasi */
        margin-bottom: 20px; /* Beri jarak dengan elemen lain */
    }

    .form-label {
        font-weight: bold;
        color: black;
        display: block;
        margin-bottom: 8px; /* Tambahkan jarak antara label dan input */
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px; /* Membuat input lebih rounded */
        padding: 10px; /* Tambahkan padding untuk kenyamanan pengguna */
        font-size: 16px; /* Ukuran font yang lebih besar untuk kenyamanan membaca */
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); /* Tambahkan sedikit shadow di dalam input */
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25); /* Efek fokus biru yang lebih lembut */
    }

    .btn-primary {
        background-color: #007bff;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%; /* Tombol memanjang ke seluruh lebar form */
        margin-top: 20px; /* Tambahkan jarak di atas tombol */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Efek hover untuk tombol */
    }

    /* Responsiveness untuk tampilan mobile */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 20px;
        }

        .btn-primary {
            font-size: 14px;
        }
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
