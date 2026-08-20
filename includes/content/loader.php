<?php
/**
 * Loads the release content and makes it available as $release.
 *
 * Two things happen here:
 *
 * 1. The current app version is looked up from the GitHub releases API, so
 *    the site cannot advertise an outdated version. The result is cached in
 *    a file; the value in content/release.php is the fallback.
 *
 * 2. {site_version} and {app_version} placeholders are substituted in every
 *    text, so no number is ever written twice.
 *
 * Nothing in here is allowed to break a page. Every failure path ends in the
 * fallback value from content/release.php.
 */

if (!defined('RELEASE_CACHE_TTL')) {
    /** How long a looked up version is trusted, in seconds. */
    define('RELEASE_CACHE_TTL', 3600);
}

/**
 * Reads the newest release version from GitHub, e.g. "1.2".
 *
 * Returns the fallback unchanged when anything at all goes wrong: no cURL,
 * no network, rate limited, unexpected payload. The lookup result is cached
 * either way - including failures - so an unreachable API costs one slow
 * request per hour and not one per page view.
 *
 * @param string $apiRepo  "owner/repo", or "" to disable the lookup
 * @param string $fallback version from content/release.php
 * @return string
 */
function release_lookup_version($apiRepo, $fallback)
{
    if ($apiRepo === '') {
        return $fallback;
    }

    $cacheFile = __DIR__ . '/../../cache/latest-release.json';

    // A fresh cache entry wins, even when it holds the fallback: that is the
    // negative cache that keeps a broken API from slowing every page down.
    $cached = @file_get_contents($cacheFile);
    if ($cached !== false) {
        $entry = json_decode($cached, true);
        if (is_array($entry)
            && isset($entry['version'], $entry['checked'])
            && (time() - (int)$entry['checked']) < RELEASE_CACHE_TTL
        ) {
            return (string)$entry['version'];
        }
    }

    $version = release_fetch_version($apiRepo);

    if ($version === '') {
        // Keep any older value rather than falling back to a stale file: a
        // version we successfully read yesterday still beats the hardcoded one.
        if (isset($entry['version']) && $entry['version'] !== '') {
            $version = (string)$entry['version'];
        } else {
            $version = $fallback;
        }
    }

    release_write_cache($cacheFile, $version);

    return $version;
}

/**
 * The actual request. Returns "" on any failure - callers decide what to do.
 *
 * Timeouts are deliberately short. This runs while a visitor waits for the
 * page, so a slow API must never hold the render.
 */
function release_fetch_version($apiRepo)
{
    $url = 'https://api.github.com/repos/' . $apiRepo . '/releases/latest';

    // GitHub rejects requests without a User-Agent.
    $userAgent = 'softknight-website/1.0 (+https://softknight.de)';
    $headers = [
        'Accept: application/vnd.github+json',
        'User-Agent: ' . $userAgent,
    ];

    $body = false;

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_USERAGENT      => $userAgent,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $body = curl_exec($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body === false || $status !== 200) {
            $body = false;
        }
    } else {
        $context = stream_context_create([
            'http' => [
                'method'        => 'GET',
                'timeout'       => 5,
                'header'        => implode("\r\n", $headers) . "\r\n",
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer'      => true,
                'verify_peer_name' => true,
            ],
        ]);
        $body = @file_get_contents($url, false, $context);
    }

    if ($body === false) {
        return '';
    }

    $data = json_decode($body, true);
    if (!is_array($data) || !isset($data['tag_name'])) {
        return '';
    }

    return release_short_version((string)$data['tag_name']);
}

/**
 * Turns a release tag into the "major.minor" the site talks in:
 * "v1.2.0" becomes "1.2". Pre-release tags such as "v1.3.0-beta.2" are
 * rejected - the site advertises stable versions only, and /releases/latest
 * should never return one anyway.
 *
 * @return string "" when the tag does not look like a version
 */
function release_short_version($tag)
{
    $tag = ltrim(trim($tag), 'vV');

    if (strpos($tag, '-') !== false) {
        return '';
    }

    if (!preg_match('/^(\d+)\.(\d+)/', $tag, $matches)) {
        return '';
    }

    return $matches[1] . '.' . $matches[2];
}

/**
 * Stores the looked up version. Failure is not reported: on a host where the
 * directory is not writable the site still works, it just asks GitHub more
 * often.
 */
function release_write_cache($cacheFile, $version)
{
    $dir = dirname($cacheFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }

    @file_put_contents(
        $cacheFile,
        json_encode(['version' => $version, 'checked' => time()]),
        LOCK_EX
    );
}

/**
 * Replaces {site_version} and {app_version} in every string of the array.
 */
function release_apply_placeholders($value, array $replacements)
{
    if (is_array($value)) {
        foreach ($value as $key => $item) {
            $value[$key] = release_apply_placeholders($item, $replacements);
        }
        return $value;
    }

    if (is_string($value)) {
        return strtr($value, $replacements);
    }

    return $value;
}

$release = require __DIR__ . '/release.php';

$release['app_version'] = release_lookup_version(
    isset($release['links']['api_repo']) ? $release['links']['api_repo'] : '',
    $release['app_version']
);

$release = release_apply_placeholders($release, [
    '{site_version}' => $release['site_version'],
    '{app_version}'  => $release['app_version'],
]);
