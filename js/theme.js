// js/theme.js
/**
 * Theme switcher. Loaded in <head> so the theme attribute is set before
 * the page renders (no flash of the wrong theme).
 *
 * Order of precedence: user choice (localStorage) > OS preference > light.
 */
(function () {
    'use strict';

    function currentTheme() {
        return document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        document.querySelectorAll('.theme-toggle').forEach(function (button) {
            button.textContent = theme === 'dark' ? '☀️' : '🌙';
            button.setAttribute('aria-label',
                theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');
            button.title = theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme';
        });
    }

    // Apply as early as possible (before first paint)
    var stored = null;
    try { stored = localStorage.getItem('theme'); } catch (e) { /* blocked storage */ }

    var initial = stored === 'dark' || stored === 'light'
        ? stored
        : (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    document.documentElement.setAttribute('data-theme', initial);

    document.addEventListener('DOMContentLoaded', function () {
        applyTheme(currentTheme());

        document.querySelectorAll('.theme-toggle').forEach(function (button) {
            button.addEventListener('click', function () {
                var next = currentTheme() === 'dark' ? 'light' : 'dark';
                applyTheme(next);
                try { localStorage.setItem('theme', next); } catch (e) { /* blocked storage */ }
            });
        });

        // Follow OS changes as long as the user hasn't chosen manually
        if (!stored && window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
                var manual = null;
                try { manual = localStorage.getItem('theme'); } catch (err) { }
                if (!manual) {
                    applyTheme(e.matches ? 'dark' : 'light');
                }
            });
        }
    });
})();
