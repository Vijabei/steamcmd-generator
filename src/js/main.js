// js/main.js
/**
 * Main JavaScript file for general functionality
 */

// Warte bis das DOM vollst�ndig geladen ist
document.addEventListener('DOMContentLoaded', function() {
    // Füge .active Klasse zum aktuellen Menüpunkt hinzu
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

function updateSliderWidth() {
    const slider = document.querySelector('.cards-slider');
    const cards = slider.querySelectorAll('.main-card');
    slider.style.width = `${cards.length * 100}%`;
    cards.forEach(card => {
        card.style.width = `${100 / cards.length}%`;
    });
}

// Aufrufen beim Laden und bei Größenänderungen
window.addEventListener('load', updateSliderWidth);
window.addEventListener('resize', updateSliderWidth);


// Guide Navigation System
class GuideNavigation {
    constructor() {
        this.container = document.querySelector('.cards-container');
        this.slider = document.querySelector('.cards-slider');
        this.cards = Array.from(document.querySelectorAll('.main-card'));
        this.currentIndex = 0;
        
        if (this.container && this.slider && this.cards.length > 0) {
            this.createNavigation();
            this.bindEvents();
            this.handleInitialHash();
        }
    }

    createNavigation() {
        const nav = document.createElement('div');
        nav.className = 'guide-navigation';
        
        this.cards.forEach((card, index) => {
            const button = document.createElement('button');
            button.className = 'nav-button';
            button.textContent = `${index + 1}`;
            button.setAttribute('aria-label', `Go to section ${index + 1}`);
            button.addEventListener('click', () => this.showCard(index));
            nav.appendChild(button);
        });
        
        this.container.insertBefore(nav, this.slider);
    }

    bindEvents() {
        window.addEventListener('hashchange', () => this.handleHash());
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') this.nextCard();
            if (e.key === 'ArrowLeft') this.previousCard();
        });
    }

    showCard(index) {
        if (index < 0 || index >= this.cards.length) return;
        
        this.slider.style.transform = `translateX(-${index * 100}%)`;
        this.currentIndex = index;
        
        this.updateNavigationState();
        
        const cardId = this.cards[index].id;
        if (cardId) {
            history.pushState(null, null, `#${cardId}`);
        }
    }

    updateNavigationState() {
        const buttons = document.querySelectorAll('.nav-button');
        buttons.forEach((button, index) => {
            button.classList.toggle('active', index === this.currentIndex);
        });
    }

    handleHash() {
        const hash = window.location.hash;
        if (hash) {
            const targetCard = this.cards.findIndex(card => `#${card.id}` === hash);
            if (targetCard >= 0) {
                this.showCard(targetCard);
            }
        }
    }

    handleInitialHash() {
        if (window.location.hash) {
            this.handleHash();
        }
    }

    nextCard() {
        this.showCard(this.currentIndex + 1);
    }

    previousCard() {
        this.showCard(this.currentIndex - 1);
    }
}

// Main functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Guide Navigation if on guide page
    new GuideNavigation();
    
    // Add active class to current nav item
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-main a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Smooth Scroll for anchor links
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

    // Initialize Collapsible Warning
    const warning = document.querySelector('.warning');
    const warningHeader = warning?.querySelector('.warning-header');
    const warningContent = warning?.querySelector('.warning-content');

    if (warning && warningHeader && warningContent) {
        const isCollapsed = localStorage.getItem('warningCollapsed') === 'true';
        if (isCollapsed) {
            warning.classList.add('collapsed');
        }

        warningHeader.addEventListener('click', function() {
            warning.classList.toggle('collapsed');
            localStorage.setItem('warningCollapsed', warning.classList.contains('collapsed'));
        });
    }
});

// Global helper function for messages
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 3000);
}