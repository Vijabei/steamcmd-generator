// js/theme.js
/**
 * Theme switcher. Loaded in <head> so the theme attribute is set before
 * the page renders (no flash of the wrong theme).
 *
 * Adding a new theme:
 *   1. Create css/themes/<name>.css with html[data-theme="<name>"] { ... }
 *   2. Link it in includes/header.php
 *   3. Add the name to THEMES below and an <option> to the navigation select
 *
 * Order of precedence: user choice (localStorage) > OS preference > light.
 */
(function () {
    'use strict';

    var THEMES = ['light', 'dark', 'steam'];

    function applyTheme(theme) {
        if (THEMES.indexOf(theme) === -1) theme = 'light';
        document.documentElement.setAttribute('data-theme', theme);
        document.querySelectorAll('.theme-select').forEach(function (select) {
            select.value = theme;
        });
        return theme;
    }

    function storedTheme() {
        try {
            var value = localStorage.getItem('theme');
            return THEMES.indexOf(value) !== -1 ? value : null;
        } catch (e) {
            return null;
        }
    }

    // Apply as early as possible (before first paint)
    var initial = storedTheme() ||
        (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', initial);

    document.addEventListener('DOMContentLoaded', function () {
        applyTheme(document.documentElement.getAttribute('data-theme'));

        document.querySelectorAll('.theme-select').forEach(function (select) {
            select.addEventListener('change', function () {
                var theme = applyTheme(select.value);
                try { localStorage.setItem('theme', theme); } catch (e) { /* blocked storage */ }
            });
        });

        // Follow OS changes as long as the user hasn't chosen manually
        if (!storedTheme() && window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
                if (!storedTheme()) {
                    applyTheme(e.matches ? 'dark' : 'light');
                }
            });
        }
    });
})();
