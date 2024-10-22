@extends( $layout)
@section('title', 'Setting')
@section('contents')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Link Font Awesome -->

<style>
    .container {
        background: linear-gradient(to bottom, #366389 18%, white 18%);
        padding: 40px 20px;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        max-width: 600px;
        margin: 0 auto;
    }

    h2 {
        color: white;
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .alert-success {
        font-weight: bold;
        color: black;
        background-color: #d4edda;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
        color: black;
        display: block;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
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
        width: 100%;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
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

    .icon {
        margin-right: 8px;
        color: #007bff;
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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Bagian form -->
    <form action="{{ route('setting.update') }}" method="POST" id="settingsForm" novalidate>
        @csrf
        <!-- Update Email -->
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="fas fa-envelope icon"></i> Email
            </label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            <div class="invalid-feedback">Email harus diisi dan valid.</div>
        </div>

        <!-- Update Password -->
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="fas fa-lock icon"></i> Password Baru
            </label>
            <input type="password" class="form-control" id="password" name="password" minlength="8">
            <div class="invalid-feedback">Password harus minimal 8 karakter.</div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                <i class="fas fa-lock icon"></i> Konfirmasi Password
            </label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            <div class="invalid-feedback">Konfirmasi password harus cocok.</div>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </form>

    <script>
        (function() {
            'use strict';

            var form = document.getElementById('settingsForm');
            var password = document.getElementById('password');
            var passwordConfirmation = document.getElementById('password_confirmation');

            form.addEventListener('submit', function(event) {
                var isValid = true;

                // Validasi jika password diisi tapi konfirmasi kosong
                if (password.value !== "" && passwordConfirmation.value === "") {
                    passwordConfirmation.setCustomValidity("Konfirmasi password harus diisi.");
                    isValid = false;
                } else {
                    passwordConfirmation.setCustomValidity(""); // Reset pesan error
                }

                // Validasi jika password dan konfirmasi password tidak cocok
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity("Konfirmasi password harus sama dengan password.");
                    isValid = false;
                } else {
                    passwordConfirmation.setCustomValidity(""); // Reset pesan error
                }

                // Cek validitas form secara keseluruhan
                if (!form.checkValidity() || !isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>
</div>
@endsection
