// Ambil elemen-elemen untuk toggle sidebar dan tombol kompas
const menuToggle = document.getElementById('menu-toggle');
const compassToggle = document.getElementById('compass-toggle');

// Ambil elemen container utama dan sidebar
const container = document.querySelector('.container');
const sidebar = document.getElementById('sidebar');

// Tambahkan event listener untuk menampilkan atau menyembunyikan sidebar saat 'menuToggle' atau 'compassToggle' diklik
menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});
compassToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

// Konfigurasi Chart.js untuk menampilkan grafik batang di elemen dengan ID 'myChart'
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Refund', 'Destinasi', 'Cek Fakta', 'Pembayaran'], // Label untuk setiap batang grafik
        datasets: [{
            label: 'Laporan', // Label untuk data
            data: [18, 5, 12, 20], // Data laporan untuk masing-masing kategori
            backgroundColor: [ // Warna latar belakang untuk setiap batang
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [ // Warna border untuk setiap batang
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1 // Lebar border
        }]
    },
    options: {
        responsive: true, // Membuat grafik responsif
        maintainAspectRatio: false, // Menjaga rasio grafik
        scales: {
            y: {
                beginAtZero: true // Mulai dari nol pada sumbu y
            }
        }
    }
});

// Menambahkan fitur notifikasi saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.querySelector(".notification"); // Ikon notifikasi
    const notificationContainer = document.createElement("div"); // Membuat kontainer untuk notifikasi
    notificationContainer.className = "notification-container";

    // Contoh data notifikasi yang akan ditampilkan
    const notifications = [
        { message: "Notifikasi 1: Laporan baru tersedia", date: "15 September 2024 09:00" },
        { message: "Notifikasi 2: Tindak lanjut laporan", date: "14 September 2024 10:30" },
    ];

    // Cek apakah ada notifikasi baru
    const hasNotifications = notifications.length > 0;

    if (hasNotifications) {
        // Tambahkan badge notifikasi di ikon jika ada notifikasi baru
        const badge = document.createElement("span");
        badge.className = "notification-badge";
        badge.textContent = notifications.length;
        notificationIcon.appendChild(badge);

        // Menambahkan item notifikasi ke dalam kontainer notifikasi
        notifications.forEach(notification => {
            const item = document.createElement("div");
            item.className = "notification-item";
            item.innerHTML = `<strong>${notification.message}</strong><br><span>${notification.date}</span>`;
            notificationContainer.appendChild(item);
        });

        // Toggle tampil atau sembunyikan notifikasi saat ikon diklik
        notificationIcon.addEventListener("click", function () {
            notificationContainer.style.display = notificationContainer.style.display === "none" ? "block" : "none";
        });

        // Menambahkan kontainer notifikasi ke dalam body
        document.body.appendChild(notificationContainer);

        // Menutup kontainer notifikasi jika klik di luar area kontainer
        document.addEventListener("click", function (event) {
            if (!notificationIcon.contains(event.target) && !notificationContainer.contains(event.target)) {
                notificationContainer.style.display = "none";
            }
        });
    }
});

// Konfigurasi modal untuk profil
var modal = document.getElementById("profileModal"); // Ambil elemen modal profil
var profileIcon = document.querySelector(".bx-user.profile"); // Ikon profil pengguna
var closeButton = document.querySelector(".close-button"); // Tombol untuk menutup modal
var editProfileButton = document.getElementById("editProfileBtn"); // Tombol untuk mengedit profil

// Ketika ikon profil diklik, buka modal
profileIcon.onclick = function() {
    modal.style.display = "block";
}

// Ketika tombol close diklik, tutup modal
closeButton.onclick = function() {
    modal.style.display = "none";
}

// Tutup modal jika area di luar modal diklik
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Logika untuk tombol edit profil
editProfileButton.onclick = function() {
    alert("Fitur edit profil akan ditambahkan di sini.");
}
