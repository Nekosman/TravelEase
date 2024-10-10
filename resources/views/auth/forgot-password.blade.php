<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>TravelEase | Forgot Password</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Forgot Password Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="images/1.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Lupa Password?</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Jangan khawatir, masukkan email Anda untuk mengatur ulang kata sandi.</small>
            </div> 

            <!-------------------- ------ Right Box ---------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">

                    <!-- Back arrow -->
                    <div class="col-12 mb-4">
                        <a href="{{ route('landing.page') }}" class="text-dark">
                            <i class="bi bi-arrow-left fs-4"></i> <!-- Icon Bootstrap -->
                        </a>
                    </div>

                    <!-- Tampilkan Notifikasi Sukses -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Header Text -->
                    <div class="header-text mb-4">
                        <h2>Lupa Password</h2>
                        <p>Masukkan email Anda untuk menerima link reset password.</p>
                    </div>

                    <!-- Forgot Password Form -->
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email" required>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Kirim Link Reset Password</button>
                        </div>
                    </form>

                    <!-- Sign Up Link -->
                    <div class="row">
                        <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
