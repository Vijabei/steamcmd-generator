<?php
/**
 * Site configuration - SAMPLE
 *
 * Copy this file to config.php and adjust the values for your deployment.
 * config.php is intentionally not under version control.
 */

// Site identity
define('SITE_NAME', 'SoftKnight');
define('SITE_TITLE', 'Steam Workshop Collection Downloader');
define('SITE_DESCRIPTION', 'Download Steam Workshop Collections easily');

// Absolute base URL of this site, without a trailing slash.
// Used for canonical links and CORS.
define('BASE_URL', 'https://www.example.com');

// Origins that may call generate.php cross-origin.
// steamcommunity.com is required for the Tampermonkey script.
define('ALLOWED_ORIGINS', [
    'https://steamcommunity.com',
    BASE_URL
]);

// Path helpers (no need to change these)
$isSubDirectory = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false;
$cssPath = $isSubDirectory ? '../css' : './css';
$jsPath = $isSubDirectory ? '../js' : './js';
$faviconPath = $isSubDirectory ? '../favicon.png' : './favicon.png';
