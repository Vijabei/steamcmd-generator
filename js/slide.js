document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.cards-container');
    if (container) {
        const cardCount = container.getAttribute('data-card-count');
        document.documentElement.style.setProperty('--card-count', cardCount);
    }
});