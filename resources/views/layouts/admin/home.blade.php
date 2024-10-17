@extends('layouts.admin.sidebar')

@section('contents')
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="{{ asset('assets/css/dashboardcs.css') }}" rel="stylesheet">


    
    <!-- Row for Total Widgets -->
    <div class="total_widget_row">
        <div class="container">
            <div class="text-container">
                <h3 class="bookk">Total User</h3>
                <h5 class="bookk">{{ $totalUsers }}</h5>
            </div>
            <i class='bx bx-group user-icon'></i>
        </div>

        <div class="container1">
            <div class="text-container">
                <h3 class="laporan_terpending">Laporan Terpending</h3>
                <h5 class="laporan_terpending">{{ $totalPending }}</h5>
            </div>
            <i class='bx bx-time user-icon'></i>
        </div>

        <div class="container2">
            <div class="text-container">
                <h3 class="laporan_selesai">Laporan Terselesaikan</h3>
                <h5 class="laporan_selesai">{{ $totalClosed  }}</h5>
            </div>
            <i class='bx bx-check user-icon'></i>
        </div>
    </div>

    <div class="chart_report_wrapper">
        <div class="chart_container">
            <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
            <!-- Update the max-width to match the container -->
        </div>
        <div class="container5">
            <h1>Laporan Dalam Antrean</h1>
            <br>
            <div class="report-item">
                <div class="icon">Z</div>
                <div class="report-details">
                    <p class="report-title">Dugaan Penipuan dari ...</p>
                    <span class="report-date">15 September 2024 08:29</span>
                </div>
                <a href="" class="status-card">
                    <button class="btn">Ambil Laporan</button>
                </a>
            </div>
            <hr>
            <div class="report-item">
                <div class="icon">Z</div>
                <div class="report-details">
                    <p class="report-title">Dugaan Penipuan dari ...</p>
                    <span class="report-date">15 September 2024 08:29</span>
                </div>
                <button class="btn">Ambil Laporan</button>
            </div>
            <hr>
            <div class="report-item">
                <div class="icon">Z</div>
                <div class="report-details">
                    <p class="report-title">Dugaan Penipuan dari ...</p>
                    <span class="report-date">15 September 2024 08:29</span>
                </div>
                <button class="btn">Ambil Laporan</button>
            </div>
            <hr>
            <div class="report-item">
                <div class="icon">Z</div>
                <div class="report-details">
                    <p class="report-title">Dugaan Penipuan dari ...</p>
                    <span class="report-date">15 September 2024 08:29</span>
                </div>
                <button class="btn">Ambil Laporan</button>
            </div>
        </div>
    </div>
    <script>
        const xValues = ["Refund", "Pemesanan", "Pembayaran", "Destinasi", "Cek Fakta"];
        const yValues = [55, 49, 44, 24, 15];
        const barColors = ["green", "red", "orange", "purple", "brown"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "LAPORAN CHART 1 MONTH"
                }
            }
        });
    </script>
@endsection
