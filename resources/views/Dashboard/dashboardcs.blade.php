<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer Service</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <h2 id="compass-toggle"><i class="bx bx-compass"></i> TravelEase</h2>
            <ul>
                <li><a href="#"><i class="bx bx-grid-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('tickets.index') }}"><i class="bx bx-receipt"></i> Ticketing</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <i class="bx bx-menu menu-toggle" id="menu-toggle"></i>
                <h1>Dashboard Customer Service</h1>
                <div class="header-icons">
                    <i class="bx bx-bell notification"></i>
                    <i class="bx bx-user profile"></i>
                    <!-- Modal untuk Profil -->
                    <div id="profileModal" class="modal">
                        <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>Profil Pengguna</h2>
                        <p><strong>Nama:</strong> <span id="userName">Meliana Putri</span></p>
                        <p><strong>Email:</strong> <span id="userEmail">Meliana@example.com</span></p>
                        <button id="editProfileBtn">Edit Profil</button>
                    </div>
                </div>
                </div>
            </header>

            <div class="content">
                <div class="stats-container">
                    <div class="stats-box box-user">
                        <div class="text-container">
                            <h3 class="bookk">Total User</h3>
                            <h5 class="bookk">12</h5>
                        </div>
                        <i class='bx bx-group user-icon'></i>
                    </div>
                    <div class="stats-box box-laporan-pending">
                        <div class="text-container">
                            <h3 class="laporan_terpending">Laporan Terpending</h3>
                            <h5 class="laporan_terpending">1</h5>
                        </div>
                        <i class='bx bx-time user-icon'></i>
                    </div>
                    <div class="stats-box box-laporan-selesai">
                        <div class="text-container">
                            <h3 class="laporan_selesai">Laporan Terselesaikan</h3>
                            <h5 class="laporan_selesai">42</h5>
                        </div>
                        <i class='bx bx-check user-icon'></i>
                    </div>
                </div>

                <div class="chart-wrapper">
                    <canvas id="myChart"></canvas>
                </div>

                <div class="report-container">
                    <div class="report-item">
                        <i class="bx bx-user profiles"></i>
                        <div class="report-details">
                            <p class="report-title">Dugaan Penipuan dari ...</p>
                            <span class="report-date">15 September 2024 08:29</span>
                        </div>
                        <button class="btn" onclick="window.location='{{ route('chat.index') }}'">Ambil Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
