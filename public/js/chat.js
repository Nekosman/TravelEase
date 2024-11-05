// Ambil elemen dengan ID 'menu-toggle' dan 'header-title-toggle' untuk menambahkan event toggle pada sidebar
const menuToggle = document.getElementById('menu-toggle');
const headerTitleToggle = document.getElementById('header-title-toggle');

// Ambil elemen container utama dan elemen yang menampilkan pesan obrolan
const container = document.querySelector('.container');
const chatContainer = document.querySelector('.chat-container');

// Ambil elemen input untuk menulis pesan dan tombol kirim
const messageInput = document.querySelector('.message-input');
const sendButton = document.querySelector('.send-button');

// Tambahkan event listener untuk toggle sidebar ketika 'menu-toggle' diklik
menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar'); // Toggle kelas 'show-sidebar' pada container untuk memperlihatkan atau menyembunyikan sidebar
});

// Tambahkan event listener untuk toggle sidebar ketika 'header-title-toggle' diklik
headerTitleToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar'); // Toggle kelas 'show-sidebar' pada container
});

// Tambahkan event listener untuk mengirim pesan ketika tombol 'sendButton' diklik
sendButton.addEventListener('click', function() {
    const messageText = messageInput.value.trim(); // Ambil teks dari input pesan dan hapus spasi di awal/akhir
    if (messageText) { // Periksa apakah ada teks yang dimasukkan
        const newMessage = document.createElement('div'); // Buat elemen div baru untuk pesan
        newMessage.classList.add('chat-message', 'sender'); // Tambahkan kelas untuk styling sebagai pesan pengirim
        newMessage.innerHTML = `<span>${messageText}</span>`; // Isi pesan dengan teks dari input
        chatContainer.appendChild(newMessage); // Tambahkan pesan baru ke dalam chatContainer
        messageInput.value = ''; // Bersihkan input pesan setelah dikirim
        chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll chatContainer ke bawah untuk memperlihatkan pesan terbaru
    }
});

// Tambahkan event listener untuk kembali ke halaman tiket ketika elemen dengan ID 'back-to-ticket' diklik
document.getElementById('back-to-ticket').addEventListener('click', function() {
    window.location.href = "{{ route('tickets.index') }}"; // Arahkan ke halaman tiket menggunakan route Laravel
});

// Tambahkan event listener untuk toggle dropdown menu ketika 'dropdownToggle' diklik
document.getElementById('dropdownToggle').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdownMenu'); // Ambil elemen dropdown menu
    // Periksa apakah dropdown dalam keadaan tersembunyi atau ditampilkan, lalu toggle tampilannya
    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
        dropdownMenu.style.display = 'block'; // Tampilkan dropdown
    } else {
        dropdownMenu.style.display = 'none'; // Sembunyikan dropdown
    }
});
