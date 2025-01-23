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
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <!-- Neuer canonical Tag -->
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
     <div class="warning">
      <strong>&#9888; Version 2.0 BETA</strong> 
      <br>Welcome to the preview release of our Workshop Collection Downloader. Technically, everything should work. 
      <br>For the version 1, visit <a href="https://softknight.de/legacy">softknight.de/legacy</a>
      <br>I made a step back to a BETA version to do some important implementations within the help and FAQ sections and also released a special workaround as TamperMonkey Script.
    </div>
