const menuToggle = document.getElementById('menu-toggle');
const compassToggle = document.getElementById('compass-toggle');
const container = document.querySelector('.container');
const sidebar = document.getElementById('sidebar');

menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

compassToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Refund', 'Destinasi', 'Cek Fakta', 'Pembayaran'],
datasets: [{
    label: 'Laporan',
    data: [18, 5, 12, 20],
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
    ],
    borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
    ],
    borderWidth: 1
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
scales: {
    y: {
        beginAtZero: true
    }
}
}
});
document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.querySelector(".notification");
    const notificationContainer = document.createElement("div");
    notificationContainer.className = "notification-container";

    // Contoh data notifikasi
    const notifications = [
        { message: "Notifikasi 1: Laporan baru tersedia", date: "15 September 2024 09:00" },
        { message: "Notifikasi 2: Tindak lanjut laporan", date: "14 September 2024 10:30" },
    ];

    // Cek apakah ada notifikasi baru
    const hasNotifications = notifications.length > 0;

    if (hasNotifications) {
        const badge = document.createElement("span");
        badge.className = "notification-badge";
        badge.textContent = notifications.length;
        notificationIcon.appendChild(badge);

        notifications.forEach(notification => {
            const item = document.createElement("div");
            item.className = "notification-item";
            item.innerHTML = `<strong>${notification.message}</strong><br><span>${notification.date}</span>`;
            notificationContainer.appendChild(item);
        });

        notificationIcon.addEventListener("click", function () {
            notificationContainer.style.display = notificationContainer.style.display === "none" ? "block" : "none";
        });

        // Menambahkan kontainer notifikasi ke dalam body
        document.body.appendChild(notificationContainer);

        // Menutup kontainer jika klik di luar
        document.addEventListener("click", function (event) {
            if (!notificationIcon.contains(event.target) && !notificationContainer.contains(event.target)) {
                notificationContainer.style.display = "none";
            }
        });
    }
});
// Mendapatkan modal
var modal = document.getElementById("profileModal");

// Mendapatkan ikon profil
var profileIcon = document.querySelector(".bx-user.profile");

// Mendapatkan tombol close
var closeButton = document.querySelector(".close-button");

// Mendapatkan tombol edit
var editProfileButton = document.getElementById("editProfileBtn");

// Ketika ikon profil diklik, buka modal
profileIcon.onclick = function() {
    modal.style.display = "block";
}

// Ketika tombol close diklik, tutup modal
closeButton.onclick = function() {
    modal.style.display = "none";
}

// Ketika di luar modal diklik, tutup modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Logika untuk tombol edit dapat ditambahkan di sini
editProfileButton.onclick = function() {
    // Arahkan ke halaman edit atau tampilkan form untuk edit
    alert("Fitur edit profil akan ditambahkan di sini.");
}
