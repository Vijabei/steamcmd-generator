// js/main.js
/**
 * Main JavaScript file for general functionality
 */

// Warte bis das DOM vollst�ndig geladen ist
document.addEventListener('DOMContentLoaded', function() {
    // F�ge .active Klasse zum aktuellen Men�punkt hinzu
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-main a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Smooth Scroll f�r Anker-Links
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

// Collapsible Warning functionality
document.addEventListener('DOMContentLoaded', function() {
    const warning = document.querySelector('.warning');
    const warningHeader = warning?.querySelector('.warning-header');
    const warningContent = warning?.querySelector('.warning-content');

    if (warning && warningHeader && warningContent) {
        // Check localStorage for saved state
        const isCollapsed = localStorage.getItem('warningCollapsed') === 'true';
        if (isCollapsed) {
            warning.classList.add('collapsed');
        }

        warningHeader.addEventListener('click', function() {
            warning.classList.toggle('collapsed');
            // Save state to localStorage
            localStorage.setItem('warningCollapsed', warning.classList.contains('collapsed'));
        });
    }
});