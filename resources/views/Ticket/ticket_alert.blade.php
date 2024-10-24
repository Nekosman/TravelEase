<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing Customer Service</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <h2 id="compass-toggle"><i class="bx bx-compass"></i> TravelEase</h2>
            <ul>
                <li><a href="{{ route('dashboard.index') }}"><i class="bx bx-grid-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('tickets.index') }}"><i class="bx bx-receipt"></i> Ticketing</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <i class="bx bx-menu menu-toggle" id="menu-toggle"></i>
                <div class="header-title">
                    <h3>Semuanya Tiket (02)</h3>
                    <i class="bx bx-down-arrow"></i>
                </div>
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Cari..." oninput="filterContent()">
                </div>
                <div class="header-icons">
                    <i class="bx bx-bell notification"></i>
                    <i class="bx bx-user profile"></i>
                </div>
            </header>

            <div class="content">
                <div id="no-results" style="display:none; text-align:center; font-size:20px; margin-top:20px;">
                    Nyari apa? Gaada.
                </div>

                <div class="content1">
                    <div class="status-card" id="status-card">
                        <div class="icon-container">
                            <div class="icon">
                                <i class='bx bx-message-rounded-dots'></i>
                            </div>
                        </div>
                        <div class="details">
                            <h3 class="pesanan">Refund Tiket</h3>
                            <p class="nama">Zulkifli Hartanto</p>
                        </div>
                        <div class="status-with-circle">
                            <div class="status1">
                                <span class="status-label1">On Hold</span>
                                <span class="icon-down">
                                    <i class="bx bx-down-arrow"></i>
                                </span>
                            </div>
                            <div class="icon4">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content1">
                    <div class="status-card">
                        <div class="icon-container">
                            <div class="icon">
                                <i class='bx bx-message-rounded-dots'></i>
                            </div>
                        </div>
                        <div class="details">
                            <h3 class="pesanan">Pembayaran</h3>
                            <p class="nama">Zulkifli Hartanto</p>
                        </div>
                        <div class="status-with-circle">
                            <div class="status">
                                <span class="status-label">On Hold</span>
                                <span class="icon-down">
                                    <i class="bx bx-down-arrow"></i>
                                </span>
                            </div>
                            <div class="icon4">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/ticket.js') }}"></script>
    <script>
         document.getElementById('status-card').addEventListener('click', function() {
        window.location.href = "{{ route('chat.index') }}";
    });
    </script>
</body>
</html>
