<?php
// Stelle sicher, dass die Session sicher gestartet wird
if (session_status() === PHP_SESSION_NONE) {
    $session_opts = array(
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cookie_samesite' => 'Strict'
    );
    session_start($session_opts);
}

header('X-Frame-Options: SAMEORIGIN');
header("Content-Security-Policy: default-src 'self';");

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once 'config.php';

// Canonical URL (base comes from the deployment config)
$canonicalUrl = BASE_URL . strtok($_SERVER['REQUEST_URI'], '?');

// Page-specific title/description: pages may define PAGE_TITLE and
// PAGE_DESCRIPTION before including this header; otherwise the site
// defaults from the config are used.
$pageTitle = defined('PAGE_TITLE') ? PAGE_TITLE . ' - ' . SITE_TITLE : SITE_TITLE;
$pageDescription = defined('PAGE_DESCRIPTION') ? PAGE_DESCRIPTION : SITE_DESCRIPTION;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">

    <!-- Open Graph / social embeds (Discord, Reddit, etc.) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo htmlspecialchars(SITE_NAME); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars(BASE_URL); ?>/og-image.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/style.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/layout.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/components.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/themes/dark.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/themes/steam.css">
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
    <script src="<?php echo $jsPath; ?>/theme.js"></script>
</head>
<body>
    <?php include 'navigation.php'; ?>
    <main class="container">
    <div class="warning">
      <div class="warning-header">
        <strong>&#127881; Version 2.3 - Workshop Manager 1.0 released!</strong>
        <button class="collapse-toggle" aria-expanded="true" aria-controls="warning-content">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
      </div>
<div class="warning-content" id="warning-content">
    <p>Hey gaming fans! Big update this time:</p>
    <ul class="warning-list">
        <li>Workshop Manager 1.0 is out: it now has a built-in workshop browser and resolves collections on its own - no more copying command files around. It is open source on <a href="https://github.com/Vijabei/SteamWorkshopManager" target="_blank" rel="noopener">GitHub</a>.</li>
        <li>The command generator on this site now uses the official Steam Web API - more reliable, and nested collections finally work too.</li>
        <li>Lots of small fixes across the site (broken links, mobile layout, guide navigation).</li>
        <li>New: themes! Pick Light, Dark or the new Steam look in the navigation - your choice is remembered.</li>
        <li>Found a problem? Please use the feedback form and include your contact info so I can get back to you!</li>
    </ul>
</div>
    </div>
