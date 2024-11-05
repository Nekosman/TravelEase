// Mendapatkan elemen tombol untuk toggle sidebar
const menuToggle = document.getElementById('menu-toggle');
const compassToggle = document.getElementById('compass-toggle');
const container = document.querySelector('.container');

// Mendapatkan elemen input untuk pencarian
const searchInput = document.querySelector('.search-container input');
const statusCards = document.querySelectorAll('.status-card');
const noResults = document.getElementById('no-results');

// Toggle sidebar saat tombol menu atau kompas diklik
menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});
compassToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

// Filter kartu status berdasarkan input pencarian
searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();  // Ambil input dan ubah ke huruf kecil
    let hasResults = false;  // Penanda apakah ada hasil yang cocok

    statusCards.forEach(card => {
        // Ambil teks dari elemen 'pesanan' dan 'nama' dalam setiap kartu
        const pesananText = card.querySelector('.pesanan').textContent.toLowerCase();
        const namaText = card.querySelector('.nama').textContent.toLowerCase();

        // Cek apakah teks pencarian cocok dengan 'pesanan' atau 'nama'
        if (pesananText.includes(query) || namaText.includes(query)) {
            card.style.display = '';  // Tampilkan kartu jika cocok
            hasResults = true;
        } else {
            card.style.display = 'none';  // Sembunyikan kartu jika tidak cocok
        }
    });

    // Tampilkan pesan "tidak ada hasil" jika tidak ada kartu yang cocok
    noResults.style.display = hasResults ? 'none' : 'block';
});

// Menjalankan setelah halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.querySelector(".notification"); // Ikon notifikasi
    const notificationContainer = document.createElement("div"); // Kontainer untuk notifikasi
    notificationContainer.className = "notification-container";

    // Data notifikasi contoh
    const notifications = [
        { message: "Notifikasi 1: Laporan baru tersedia", date: "15 September 2024 09:00" },
        { message: "Notifikasi 2: Tindak lanjut laporan", date: "14 September 2024 10:30" },
    ];

    // Cek apakah ada notifikasi baru
    const hasNotifications = notifications.length > 0;

    if (hasNotifications) {
        // Buat badge untuk jumlah notifikasi dan tambahkan ke ikon notifikasi
        const badge = document.createElement("span");
        badge.className = "notification-badge";
        badge.textContent = notifications.length;
        notificationIcon.appendChild(badge);

        // Tambahkan setiap notifikasi ke dalam kontainer
        notifications.forEach(notification => {
            const item = document.createElement("div");
            item.className = "notification-item";
            item.innerHTML = `<strong>${notification.message}</strong><br><span>${notification.date}</span>`;
            notificationContainer.appendChild(item);
        });

        // Toggle tampilan notifikasi saat ikon diklik
        notificationIcon.addEventListener("click", function () {
            notificationContainer.style.display = notificationContainer.style.display === "none" ? "block" : "none";
        });

        // Tambahkan kontainer notifikasi ke dalam body
        document.body.appendChild(notificationContainer);

        // Tutup kontainer notifikasi jika klik di luar area kontainer
        document.addEventListener("click", function (event) {
            if (!notificationIcon.contains(event.target) && !notificationContainer.contains(event.target)) {
                notificationContainer.style.display = "none";
            }
        });
    }
});

// Mendapatkan elemen modal untuk profil
var modal = document.getElementById("profileModal");
var profileIcon = document.querySelector(".bx-user.profile"); // Ikon profil
var closeButton = document.querySelector(".close-button"); // Tombol close di modal
var editProfileButton = document.getElementById("editProfileBtn"); // Tombol edit profil

// Tampilkan modal saat ikon profil diklik
profileIcon.onclick = function() {
    modal.style.display = "block";
}

// Tutup modal saat tombol close diklik
closeButton.onclick = function() {
    modal.style.display = "none";
}

// Tutup modal saat klik di luar area modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Tambahkan logika untuk tombol edit
editProfileButton.onclick = function() {
    // Contoh: Tampilkan alert atau arahkan ke halaman edit profil
    alert("Fitur edit profil akan ditambahkan di sini.");
}
