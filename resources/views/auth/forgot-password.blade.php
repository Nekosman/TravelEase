<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>TravelEase | Reset Password</title>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="images/1.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Reset Password</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Masukkan password lama dan buat password baru.</small>
            </div> 

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="col-12 mb-4">
                        <a href="{{ route('landing.page') }}" class="text-dark">
                            <i class="bi bi-arrow-left fs-4"></i>
                        </a>
                    </div>

                    <!-- Display Success Notification -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Error Notification for Old Password -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="header-text mb-4">
                        <h2>Reset Password</h2>
                        <p>Masukkan password lama dan password baru.</p>
                    </div>

                    <!-- Reset Password Form -->
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password Lama" name="old_password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password Baru" name="new_password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Konfirmasi Password Baru" name="new_password_confirmation" required>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Reset Password</button>
                        </div>
                    </form>

                    <div class="row">
                        <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
