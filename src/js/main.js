// js/main.js
/**
 * Main JavaScript file for general functionality
 */

// Warte bis das DOM vollständig geladen ist
document.addEventListener('DOMContentLoaded', function() {
    // Füge .active Klasse zum aktuellen Menüpunkt hinzu
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-main a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Smooth Scroll für Anker-Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            document.querySelector(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});

// Globale Hilfsfunktionen
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 3000);
}
