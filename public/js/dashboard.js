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
