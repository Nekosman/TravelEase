const menuToggle = document.getElementById('menu-toggle');
const compassToggle = document.getElementById('compass-toggle');
const container = document.querySelector('.container');
const searchInput = document.querySelector('.search-container input');
const statusCards = document.querySelectorAll('.status-card');
const noResults = document.getElementById('no-results');

menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

compassToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    let hasResults = false;

    statusCards.forEach(card => {
        const pesananText = card.querySelector('.pesanan').textContent.toLowerCase();
        const namaText = card.querySelector('.nama').textContent.toLowerCase();

        if (pesananText.includes(query) || namaText.includes(query)) {
            card.style.display = '';
            hasResults = true;
        } else {
            card.style.display = 'none';
        }
    });

    noResults.style.display = hasResults ? 'none' : 'block';
});

