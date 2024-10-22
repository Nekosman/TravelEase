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
                    <h5 class="laporan_selesai">{{ $totalClosed }}</h5>
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
                @forelse ($tickets as $ticket)
                    <div class="report-item">
                       
                        <div class="report-details">
                            <p class="report-title">Ticket {{ $ticket->title }} From {{ $ticket->user->name }}</p>
                            <p class="report-description">Description : {{ $ticket->description }}</p>
                            <span class="report-date">{{ $ticket->created_at->format('d F Y H:i') }}</span> 
                        </div>
                        {{-- <a href="{{ route('admin.take_ticket', $ticket->id) }}" class="status-card">
                            <button class="btn">Ambil Laporan</button>
                            <!-- Link to the action where the admin takes the ticket -->
                        </a> --}}
                    </div>
                @empty
                    <p>Tidak ada laporan dalam antrean.</p>
                @endforelse
                <hr>
            </div>

        </div>
        <script>
            const xValues = ["Laporan selesai", "Laporan terpending", "User", "Destinasi", "Cek Fakta"];
            const yValues = [45, 40, 35, 24, 15];
            const barColors = ["green", "orange", "navy", "purple", "brown"];

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
