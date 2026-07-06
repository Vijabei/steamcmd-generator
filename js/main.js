// js/main.js
/**
 * Main JavaScript file for general functionality.
 *
 * Note: the guide card slider is laid out purely in CSS
 * (.cards-slider is a flex row, each .main-card is flex: 0 0 100%).
 * JavaScript only moves the slider via translateX. Do not set widths
 * from JS here - that caused cards to be cut off on the right side.
 */

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
            const title = card.querySelector('h2');
            button.setAttribute('aria-label', title ? title.textContent : `Go to section ${index + 1}`);
            if (title) button.title = title.textContent;
            button.addEventListener('click', () => this.showCard(index));
            nav.appendChild(button);
        });

        this.container.insertBefore(nav, this.slider);
        this.updateNavigationState();
    }

    bindEvents() {
        window.addEventListener('hashchange', () => this.handleHash());

        document.addEventListener('keydown', (e) => {
            // Don't hijack arrow keys while typing in a form field
            const tag = document.activeElement?.tagName;
            if (tag === 'INPUT' || tag === 'TEXTAREA') return;

            if (e.key === 'ArrowRight') this.nextCard();
            if (e.key === 'ArrowLeft') this.previousCard();
        });
    }

    showCard(index) {
        if (index < 0 || index >= this.cards.length) return;

        // The browser's native anchor scrolling may have scrolled the
        // overflow:hidden container horizontally - undo that, the card
        // position is controlled via transform only.
        this.container.scrollLeft = 0;

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
        if (!hash) return;

        // The hash may point to a card itself or to an anchor inside a card
        const target = document.querySelector(hash);
        if (!target) return;

        const card = target.closest('.main-card') || target;
        const index = this.cards.indexOf(card);
        if (index >= 0) {
            this.showCard(index);
        }
    }

    handleInitialHash() {
        if (window.location.hash) {
            this.handleHash();
        }

        // Native anchor scrolling can kick in around the load event and
        // shift the container again - reset it once everything settled.
        window.addEventListener('load', () => {
            this.container.scrollLeft = 0;
        });
    }

    nextCard() {
        this.showCard(this.currentIndex + 1);
    }

    previousCard() {
        this.showCard(this.currentIndex - 1);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Guide Navigation if on guide page
    new GuideNavigation();

    // Add active class to current nav item
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-main a').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Smooth scroll for same-page anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Collapsible info banner
    const warning = document.querySelector('.warning');
    const warningHeader = warning?.querySelector('.warning-header');
    const warningContent = warning?.querySelector('.warning-content');

    if (warning && warningHeader && warningContent) {
        const setExpanded = (collapsed) => {
            warning.classList.toggle('collapsed', collapsed);
            warningHeader.querySelector('.collapse-toggle')
                ?.setAttribute('aria-expanded', String(!collapsed));
        };

        setExpanded(localStorage.getItem('warningCollapsed') === 'true');

        warningHeader.addEventListener('click', function () {
            const collapsed = !warning.classList.contains('collapsed');
            setExpanded(collapsed);
            localStorage.setItem('warningCollapsed', String(collapsed));
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
