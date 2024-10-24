<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer Service</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="header-title" id="header-title-toggle">
                <i class='bx bx-left-arrow-alt' id="back-to-ticket"></i>
                <h3>Semuanya Tiket (02)</h3>
                <i class="bx bx-down-arrow"></i>
            </div>
            <div class="content">
                <div class="card">
                    <h4 class="teks1">Refund Tiket</h4>
                    <div class="card-content">
                        <span>Zulfikiri</span>
                        <i class='bx bx-user icons'></i>
                        <button class="btn-open">Open</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <header>
                <i class="bx bx-menu menu-toggle" id="menu-toggle"></i>
                <div class="header-content">
                    <i class='bx bx-message-rounded-dots'></i>
                    <div class="header-text">
                        <h4>Refund Tiket</h4>
                        <span>Zulfikiri - dibuat tanggal 12 Agustus 2024</span>
                    </div>
                </div>
                <div class="dropdown">
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <button class="btn-open1">Open</button>
                </div>
            </header>

            <div class="content">
                <div class="date-container">
                    <hr class="date-divider">
                    <span class="date-text">Jan, 19 Sep</span>
                    <hr class="date-divider">
                </div>
                <div class="chat-container">
                    <div class="chat-message sender">
                        <span>
                            Halo, saya Meliana Putri! Saya di sini untuk membantu Anda dalam perjalanan Anda dengan aplikasi TravelEase. Sebagai customer service, saya siap memberikan informasi, menjawab pertanyaan, dan membantu menyelesaikan masalah yang mungkin Anda hadapi selama perjalanan.<br><br>
                            Apakah Anda memerlukan bantuan untuk memesan tiket, mengubah jadwal, atau mencari rekomendasi destinasi? Jangan ragu untuk bertanya, dan saya akan memastikan Anda mendapatkan informasi dan dukungan yang Anda butuhkan.<br><br>
                            Selamat berpergian!
                        </span>
                        <h6 class="message-time">12:00</h6>
                    </div>
                    <div class="chat-message receiver">
                        <span>
                            Apakah saya bisa membatalkan pesanan yang sudah saya beli 1 minggu yang lalu?!
                        </span>
                        <h6 class="message-time">12:00</h6>
                    </div>
                    <div class="chat-message sender">
                        <span>
                            Untuk menentukan apakah Anda dapat membatalkan pesanan Anda, saya memerlukan beberapa informasi tambahan tentang pesanan Anda. Mohon berikan detail berikut:<br><br>
                            <strong>Nomor Pemesanan:</strong> Nomor pemesanan atau tiket yang terkait dengan pembelian Anda.<br>
                            <strong>Tanggal Pembelian:</strong> Tanggal Anda melakukan pembelian tiket tersebut.<br>
                            <strong>Tanggal Perjalanan:</strong> Tanggal keberangkatan yang tertera pada tiket.<br>
                            <strong>Nama Lengkap dan Email:</strong> Nama lengkap dan alamat email yang digunakan saat melakukan pemesanan.<br><br>
                            Dengan informasi ini, saya dapat memeriksa kebijakan pembatalan untuk pesanan Anda dan memberikan solusi yang sesuai. Silakan berikan detail tersebut, dan saya akan segera membantu Anda!
                        </span>
                        <h6 class="message-time">12:00</h6>
                    </div>
                </div>

                <div class="message-input-container">
                    <input type="text" class="message-input" placeholder="Ketik pesan...">
                    <button class="send-button">Kirim</button>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/chat.js') }}"></script>
<script>
    document.getElementById('back-to-ticket').addEventListener('click', function() {
    window.location.href = "{{ route('tickets.index') }}";
});
</script>
</body>
</html>
