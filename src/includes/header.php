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

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once 'config.php';

// Neue Logik für canonical URLs
$currentPath = $_SERVER['REQUEST_URI'];
$isLegacy = strpos($currentPath, '/legacy/') !== false;
$canonicalBase = 'https://softknight.de';

if ($isLegacy) {
    $canonicalPath = str_replace('/legacy/', '/', $currentPath);
    $canonicalUrl = $canonicalBase . $canonicalPath;
} else {
    $canonicalUrl = $canonicalBase . $currentPath;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <title><?php echo htmlspecialchars(SITE_TITLE); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars(SITE_DESCRIPTION); ?>">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/style.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/layout.css">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>/components.css">
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
</head>
<body>
    <?php include 'navigation.php'; ?>
    <main class="container">
    <div class="warning collapsible">
      <div class="warning-header">
        <strong>&#9888; Version 2.0 BETA 5 - Important Changes</strong>
        <button class="collapse-toggle" aria-expanded="true" aria-controls="warning-content">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
      </div>
      <div class="warning-content" id="warning-content">
        <p>Welcome to the new version of our Workshop Collection tool. We've made significant improvements:</p>
        <ul class="warning-list">
          <li>Redesigned as a command generator for SteamCMD</li>
          <li>New Workshop Manager tool for visual command execution</li>
          <li>Added TamperMonkey script for direct browser integration</li>
          <li>Improved documentation and guides</li>
        </ul>
        <p class="warning-note">Looking for the old version? Visit <a href="https://softknight.de/legacy">softknight.de/legacy</a></p>
      </div>
    </div>
