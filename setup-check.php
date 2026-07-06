<?php
/**
 * Setup check - verifies server requirements and helps with the initial
 * configuration (creates includes/config.php from user input).
 *
 * This page works WITHOUT an existing config.php on purpose.
 * Recommendation: delete this file from production once everything is green.
 */

session_start([
    'cookie_httponly' => true,
    'cookie_secure' => !empty($_SERVER['HTTPS']),
    'cookie_samesite' => 'Strict'
]);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

$configPath = __DIR__ . '/includes/config.php';
$configExists = file_exists($configPath);
$configCreated = false;
$configError = null;

/**
 * Suggests the base URL of the current request (scheme + host).
 */
function detectBaseUrl() {
    $scheme = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'www.example.com';
    return $scheme . '://' . $host;
}

/**
 * Minimal HTTPS POST used for the Steam API connectivity test.
 * Mirrors the logic in generate.php (cURL preferred, stream fallback).
 */
function setupHttpPost($url, array $postData, &$errorOut) {
    $content = http_build_query($postData);

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => true
        ]);
        $body = curl_exec($ch);
        if ($body === false) {
            $errorOut = curl_error($ch);
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        return $body;
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'timeout' => 15,
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $content,
            'ignore_errors' => true
        ],
        'ssl' => ['verify_peer' => true, 'verify_peer_name' => true]
    ]);

    $body = @file_get_contents($url, false, $context);
    if ($body === false) {
        $errorOut = error_get_last()['message'] ?? 'Unknown error';
        return false;
    }
    return $body;
}

/**
 * Simple HEAD/GET status probe for the web-protection check.
 */
function setupHttpStatus($url) {
    if (!function_exists('curl_init')) return null;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_NOBODY => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true
    ]);
    curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    return $status ?: null;
}

// --- Handle config creation ------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$configExists) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $configError = 'Invalid security token - please reload the page and try again.';
    } else {
        $baseUrl = rtrim(trim($_POST['base_url'] ?? ''), '/');
        $siteName = trim($_POST['site_name'] ?? 'SoftKnight');

        if (!preg_match('#^https?://[a-z0-9.-]+(:\d+)?$#i', $baseUrl)) {
            $configError = 'Please enter a valid base URL, e.g. https://www.example.com (no path, no trailing slash).';
        } elseif (!preg_match('#^[\w\s.-]{1,50}$#u', $siteName)) {
            $configError = 'Please enter a simple site name (letters, numbers, spaces).';
        } else {
            $template = <<<'PHP'
<?php
/**
 * Site configuration (created by setup-check.php)
 * See config.sample.php for documentation.
 */

// Site identity
define('SITE_NAME', '%SITE_NAME%');
define('SITE_TITLE', 'Steam Workshop Collection Downloader');
define('SITE_DESCRIPTION', 'Download Steam Workshop Collections easily');

// Absolute base URL of this site, without a trailing slash.
define('BASE_URL', '%BASE_URL%');

// Origins that may call generate.php cross-origin.
define('ALLOWED_ORIGINS', [
    'https://steamcommunity.com',
    BASE_URL
]);

// Path helpers (no need to change these)
$isSubDirectory = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false;
$cssPath = $isSubDirectory ? '../css' : './css';
$jsPath = $isSubDirectory ? '../js' : './js';
$faviconPath = $isSubDirectory ? '../favicon.png' : './favicon.png';
PHP;

            $content = str_replace(
                ['%SITE_NAME%', '%BASE_URL%'],
                [addslashes($siteName), addslashes($baseUrl)],
                $template
            );

            if (@file_put_contents($configPath, $content) !== false) {
                $configExists = true;
                $configCreated = true;
            } else {
                $configError = 'Could not write includes/config.php - please check the write permissions of the includes/ directory.';
            }
        }
    }
}

// --- Run the checks ----------------------------------------------------------

$checks = [];

function addCheck(&$checks, $status, $label, $detail) {
    $checks[] = ['status' => $status, 'label' => $label, 'detail' => $detail];
}

// PHP version
if (PHP_VERSION_ID >= 80000) {
    addCheck($checks, 'ok', 'PHP version', 'PHP ' . PHP_VERSION);
} elseif (PHP_VERSION_ID >= 70400) {
    addCheck($checks, 'warn', 'PHP version', 'PHP ' . PHP_VERSION . ' works, but PHP 8.x is recommended.');
} else {
    addCheck($checks, 'fail', 'PHP version', 'PHP ' . PHP_VERSION . ' is too old - PHP 8.x is required.');
}

// HTTPS client capability
$hasCurl = function_exists('curl_init');
$hasStreamFallback = ini_get('allow_url_fopen') && extension_loaded('openssl');
if ($hasCurl) {
    addCheck($checks, 'ok', 'HTTPS client (cURL)', 'The cURL extension is available.');
} elseif ($hasStreamFallback) {
    addCheck($checks, 'warn', 'HTTPS client', 'cURL is missing; the stream fallback (allow_url_fopen + openssl) will be used.');
} else {
    addCheck($checks, 'fail', 'HTTPS client', 'Neither cURL nor allow_url_fopen+openssl are available - the generator cannot reach the Steam Web API.');
}

// Steam Web API connectivity
if ($hasCurl || $hasStreamFallback) {
    $apiError = '';
    $body = setupHttpPost(
        'https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/',
        ['itemcount' => '1', 'publishedfileids[0]' => '818773962'],
        $apiError
    );
    $decoded = $body !== false ? json_decode($body, true) : null;
    if (is_array($decoded) && isset($decoded['response'])) {
        addCheck($checks, 'ok', 'Steam Web API', 'api.steampowered.com is reachable and answers correctly.');
    } else {
        addCheck($checks, 'fail', 'Steam Web API', 'Could not reach api.steampowered.com: ' . ($apiError ?: 'unexpected response'));
    }
} else {
    addCheck($checks, 'fail', 'Steam Web API', 'Skipped - no HTTPS client available.');
}

// Writable directories
foreach (['logs', 'feedback'] as $dir) {
    $path = __DIR__ . '/' . $dir;
    if (!is_dir($path)) {
        if (@mkdir($path, 0755, true)) {
            addCheck($checks, 'ok', "Directory {$dir}/", 'Created.');
        } else {
            addCheck($checks, 'fail', "Directory {$dir}/", 'Missing and could not be created - please create it manually.');
            continue;
        }
    }
    if (is_writable($path)) {
        addCheck($checks, 'ok', "Directory {$dir}/ writable", 'PHP can write files here.');
    } else {
        addCheck($checks, 'fail', "Directory {$dir}/ writable", 'Not writable - logging/feedback will fail. Adjust the permissions.');
    }

    if (file_exists($path . '/.htaccess')) {
        addCheck($checks, 'ok', "Protection {$dir}/.htaccess", 'Protective .htaccess is present.');
    } else {
        addCheck($checks, 'warn', "Protection {$dir}/.htaccess", 'Missing! These directories must not be readable from the web.');
    }
}

// Live web-protection probe (only meaningful once reachable via its final URL)
$probeBase = $configExists && defined('BASE_URL') ? BASE_URL : detectBaseUrl();
if ($configExists && !defined('BASE_URL')) {
    // config.php was just created in this request or defines came from sample
    @include $configPath;
    $probeBase = defined('BASE_URL') ? BASE_URL : $probeBase;
}
$probeStatus = setupHttpStatus($probeBase . '/logs/.htaccess');
if ($probeStatus === null) {
    addCheck($checks, 'warn', 'Web access to logs/', "Could not probe {$probeBase}/logs/ - please verify manually that it returns 403.");
} elseif ($probeStatus === 200) {
    addCheck($checks, 'fail', 'Web access to logs/', "{$probeBase}/logs/.htaccess returns HTTP 200 - the logs directory is publicly readable! Your web server seems to ignore .htaccess files.");
} else {
    addCheck($checks, 'ok', 'Web access to logs/', "Blocked (HTTP {$probeStatus}).");
}

// Configuration
if ($configExists) {
    addCheck($checks, 'ok', 'Configuration', $configCreated
        ? 'includes/config.php was created just now.'
        : 'includes/config.php is present.');
} else {
    addCheck($checks, 'fail', 'Configuration', 'includes/config.php is missing - use the form below to create it.');
}

// Optional deployment files
foreach (['sitemap.xml', 'robots.txt'] as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        addCheck($checks, 'ok', $file, 'Present.');
    } else {
        addCheck($checks, 'warn', $file, "Missing - copy " . str_replace('.', '.sample.', $file) . " and adjust the domain (optional, relevant for SEO).");
    }
}

$failCount = count(array_filter($checks, fn($c) => $c['status'] === 'fail'));
$warnCount = count(array_filter($checks, fn($c) => $c['status'] === 'warn'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Setup Check - Steam Workshop Collection Downloader</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/components.css">
    <link rel="stylesheet" href="./css/themes/dark.css">
    <link rel="stylesheet" href="./css/themes/steam.css">
    <link rel="icon" href="./favicon.png" type="image/png">
    <script src="./js/theme.js"></script>
    <style>
        .check-table { width: 100%; border-collapse: collapse; }
        .check-table td { padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--border-color); vertical-align: top; }
        .check-table td:first-child { white-space: nowrap; width: 1%; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: var(--font-size-sm); font-weight: 600; }
        .badge-ok { background: var(--success-light); color: var(--success-color); }
        .badge-warn { background: var(--warning-bg); color: var(--warning-text); }
        .badge-fail { background: var(--error-light); color: var(--error-color); }
        .check-label { font-weight: 600; }
        .check-detail { color: var(--text-light); font-size: var(--font-size-sm); }
        .summary-line { font-size: var(--font-size-lg); }
    </style>
</head>
<body>
    <main class="container">
        <div class="hero">
            <h1>Setup Check</h1>
            <p class="lead">Verifies the server requirements for the Workshop Collection Downloader</p>
        </div>

        <div class="card">
            <p class="summary-line">
                <?php if ($failCount === 0 && $warnCount === 0): ?>
                    ✅ <strong>Everything looks good!</strong> Your server is ready.
                <?php elseif ($failCount === 0): ?>
                    ✅ <strong>Ready with <?php echo $warnCount; ?> note(s)</strong> - see the warnings below.
                <?php else: ?>
                    ❌ <strong><?php echo $failCount; ?> problem(s) found</strong> - please fix the items marked red.
                <?php endif; ?>
            </p>

            <table class="check-table">
                <?php foreach ($checks as $check): ?>
                <tr>
                    <td>
                        <?php if ($check['status'] === 'ok'): ?>
                            <span class="badge badge-ok">OK</span>
                        <?php elseif ($check['status'] === 'warn'): ?>
                            <span class="badge badge-warn">Note</span>
                        <?php else: ?>
                            <span class="badge badge-fail">Problem</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="check-label"><?php echo htmlspecialchars($check['label']); ?></div>
                        <div class="check-detail"><?php echo htmlspecialchars($check['detail']); ?></div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <?php if (!$configExists): ?>
        <div class="card">
            <h2>Create configuration</h2>
            <p>No <code>includes/config.php</code> found yet. Enter your site details and it will be created for you:</p>

            <?php if ($configError): ?>
                <div class="message message-error"><?php echo htmlspecialchars($configError); ?></div>
            <?php endif; ?>

            <form method="post" action="setup-check.php">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div class="form-group">
                    <label for="base_url">Base URL (scheme + domain, no trailing slash):</label>
                    <input type="text" id="base_url" name="base_url" class="form-control" required
                           value="<?php echo htmlspecialchars($_POST['base_url'] ?? detectBaseUrl()); ?>">
                </div>
                <div class="form-group">
                    <label for="site_name">Site name:</label>
                    <input type="text" id="site_name" name="site_name" class="form-control" required
                           value="<?php echo htmlspecialchars($_POST['site_name'] ?? 'SoftKnight'); ?>">
                </div>
                <button type="submit" class="btn">Create config.php</button>
            </form>
        </div>
        <?php endif; ?>

        <?php if ($configCreated): ?>
        <div class="card">
            <div class="message message-success">Configuration created successfully! Reload this page to re-run all checks.</div>
        </div>
        <?php endif; ?>

        <div class="card">
            <h2>After setup</h2>
            <ul class="feature-list">
                <li>Re-run this page until everything is green.</li>
                <li>Copy <code>sitemap.sample.xml</code> → <code>sitemap.xml</code> and <code>robots.sample.txt</code> → <code>robots.txt</code>, adjust the domain (optional).</li>
                <li><strong>Delete <code>setup-check.php</code> from production servers</strong> - it reveals details about your environment.</li>
                <li>Then open <a href="./index.php">the site</a> and generate your first command list.</li>
            </ul>
        </div>
    </main>
</body>
</html>
