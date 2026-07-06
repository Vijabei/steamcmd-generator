<?php
/**
 * SteamCMD command generator.
 *
 * Resolves Steam Workshop collections via the official Steam Web API
 * (no API key required) instead of scraping the HTML pages. This is
 * more reliable, supports nested collections and avoids rate-limit
 * problems with steamcommunity.com.
 *
 * Endpoints used:
 * - ISteamRemoteStorage/GetCollectionDetails   (collection -> item ids)
 * - ISteamRemoteStorage/GetPublishedFileDetails (item ids -> app id)
 */

// Deployment config (falls back to the sample for fresh checkouts)
if (file_exists(__DIR__ . '/includes/config.php')) {
    require_once __DIR__ . '/includes/config.php';
} else {
    require_once __DIR__ . '/includes/config.sample.php';
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
    if (in_array($_SERVER['HTTP_ORIGIN'], ALLOWED_ORIGINS, true)) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Methods: POST, GET');
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    }
}

/**
 * Anonymizes an IP address for GDPR-friendly logging:
 * IPv4 -> last octet zeroed, IPv6 -> truncated to the /48 prefix.
 */
function anonymizeIp($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return preg_replace('/\.\d+$/', '.0', $ip);
    }
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $parts = explode(':', $ip);
        return implode(':', array_slice($parts, 0, 3)) . '::';
    }
    return 'unknown';
}

function logButtonClick($type = 'download', $source = 'web') {
    $logDir = __DIR__ . '/logs';
    $logFile = $logDir . '/user_interactions.log';

    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $logEntry = sprintf(
        "[%s] Action: %s, Source: %s, IP: %s, UA: %s\n",
        date('Y-m-d H:i:s'),
        $type,
        $source,
        anonymizeIp($_SERVER['REMOTE_ADDR'] ?? ''),
        $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    );

    if (@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
        error_log("Failed to write to interaction log file: " . $logFile);
    }
}

// Click counter handler
if (isset($_GET['countButtonClick'])) {
    $type = $_GET['type'] ?? 'download';
    $source = $_GET['source'] ?? 'web';
    logButtonClick($type, $source);
    exit;
}

class WorkshopCollectionProcessor {
    private const API_COLLECTION_DETAILS = 'https://api.steampowered.com/ISteamRemoteStorage/GetCollectionDetails/v1/';
    private const API_FILE_DETAILS = 'https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/';
    private const MAX_COLLECTION_DEPTH = 5;
    private const DETAILS_BATCH_SIZE = 100;

    private $logFile;
    private $userAgent = 'Mozilla/5.0 (compatible; Workshop Collection Helper/3.0; +https://softknight.de)';

    public function __construct() {
        $logDir = __DIR__ . '/logs';
        $this->logFile = $logDir . '/collection_logs.txt';

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        if (!file_exists($this->logFile)) {
            @touch($this->logFile);
            @chmod($this->logFile, 0644);
        }
    }

    private function logAccess($url) {
        $logEntry = sprintf(
            "[%s] Collection processed: %s (IP: %s, UA: %s)\n",
            date('Y-m-d H:i:s'),
            $url,
            anonymizeIp($_SERVER['REMOTE_ADDR'] ?? ''),
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        );

        if (@file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
            error_log("Failed to write to log file: " . $this->logFile);
        }
    }

    public function processRequest() {
        try {
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                throw new Exception('Invalid request method');
            }

            $collectionURL = $this->getValidatedURL($_POST["collectionURL"] ?? '');
            $collectionId = $this->extractWorkshopId($collectionURL);

            $result = $this->processCollection($collectionId);

            $this->logAccess($collectionURL);

            $response = [
                'success' => true,
                'downloadCommands' => formatCommandScript($result['commands'])
            ];

            if (!empty($result['warning'])) {
                $response['warning'] = $result['warning'];
            }

            return $response;

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function getValidatedURL($url) {
        $url = filter_var(trim($url), FILTER_SANITIZE_URL);

        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'https://' . $url;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL format');
        }

        $pattern = '#^https://steamcommunity\.com/(?:sharedfiles|workshop)/filedetails/\?id=\d+$#';
        if (!preg_match($pattern, $url)) {
            throw new Exception('Invalid Steam Workshop Collection URL format. Example: https://steamcommunity.com/sharedfiles/filedetails/?id=123456789');
        }

        return $url;
    }

    private function extractWorkshopId($url) {
        if (!preg_match('#[?&]id=(\d+)#', $url, $matches)) {
            throw new Exception('Could not extract workshop id from URL');
        }
        return $matches[1];
    }

    /**
     * Resolves a collection id to SteamCMD commands. Nested collections
     * are resolved recursively; a single workshop item (not a collection)
     * is handled as a one-item download.
     *
     * @return array{commands: array, warning: ?string}
     */
    private function processCollection($collectionId) {
        $itemIds = [];
        $visited = [];
        $this->collectItemIds($collectionId, $itemIds, $visited, 0);

        // No children: the id itself may be a single workshop item
        if (empty($itemIds)) {
            $itemIds[] = $collectionId;
        }

        // Resolve the app id for each item
        $details = $this->fetchFileDetails($itemIds);

        $commands = [];
        $skipped = 0;

        foreach ($itemIds as $itemId) {
            $appId = $details[$itemId] ?? null;
            if ($appId !== null) {
                $commands[] = sprintf('workshop_download_item %d %d', $appId, $itemId);
            } else {
                $skipped++;
            }
        }

        if (empty($commands)) {
            throw new Exception('Collection appears to be empty or the items are not accessible');
        }

        $warning = $skipped > 0
            ? "Note: {$skipped} item(s) could not be resolved and were skipped."
            : null;

        return ['commands' => $commands, 'warning' => $warning];
    }

    private function collectItemIds($collectionId, array &$itemIds, array &$visited, $depth) {
        if ($depth > self::MAX_COLLECTION_DEPTH || isset($visited[$collectionId])) {
            return;
        }
        $visited[$collectionId] = true;

        $response = $this->postToApi(self::API_COLLECTION_DETAILS, [
            'collectioncount' => '1',
            'publishedfileids[0]' => $collectionId
        ]);

        $details = $response['response']['collectiondetails'][0] ?? null;
        if (!$details || (int)($details['result'] ?? 0) !== 1 || empty($details['children'])) {
            return;
        }

        foreach ($details['children'] as $child) {
            $childId = $child['publishedfileid'] ?? null;
            if ($childId === null || !ctype_digit((string)$childId)) {
                continue;
            }

            // filetype 2 marks a nested collection
            if ((int)($child['filetype'] ?? 0) === 2) {
                $this->collectItemIds($childId, $itemIds, $visited, $depth + 1);
            } elseif (!in_array($childId, $itemIds, true)) {
                $itemIds[] = $childId;
            }
        }
    }

    /**
     * Fetches the consumer app id for each item id.
     *
     * @return array<string, int> map of item id => app id
     */
    private function fetchFileDetails(array $itemIds) {
        $result = [];

        foreach (array_chunk($itemIds, self::DETAILS_BATCH_SIZE) as $chunkIndex => $chunk) {
            if ($chunkIndex > 0) {
                usleep(250000); // stay well below any API rate limit
            }

            $postData = ['itemcount' => (string)count($chunk)];
            foreach ($chunk as $i => $id) {
                $postData["publishedfileids[{$i}]"] = $id;
            }

            $response = $this->postToApi(self::API_FILE_DETAILS, $postData);
            $detailsList = $response['response']['publishedfiledetails'] ?? [];

            foreach ($detailsList as $details) {
                $id = $details['publishedfileid'] ?? null;
                if ($id === null || (int)($details['result'] ?? 0) !== 1) {
                    continue;
                }

                $appId = (int)($details['consumer_app_id'] ?? $details['creator_app_id'] ?? 0);
                if ($appId > 0) {
                    $result[$id] = $appId;
                }
            }
        }

        return $result;
    }

    private function postToApi($url, array $postData) {
        $body = $this->httpPost($url, http_build_query($postData));

        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            throw new Exception('Unexpected response from the Steam Web API');
        }

        return $decoded;
    }

    /**
     * HTTPS POST helper. Prefers cURL (available on virtually every
     * shared host); falls back to stream wrappers where cURL is missing
     * but allow_url_fopen/openssl are enabled.
     */
    private function httpPost($url, $content) {
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $content,
                CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 3,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_USERAGENT => $this->userAgent,
                CURLOPT_SSL_VERIFYPEER => true
            ]);

            $body = curl_exec($ch);

            if ($body === false) {
                $error = curl_error($ch);
                curl_close($ch);
                throw new Exception("Could not reach the Steam Web API. Last error: {$error}");
            }

            curl_close($ch);
            return $body;
        }

        $options = [
            'http' => [
                'method' => 'POST',
                'user_agent' => $this->userAgent,
                'timeout' => 30,
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $content,
                'ignore_errors' => true
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true
            ]
        ];

        $body = @file_get_contents($url, false, stream_context_create($options));

        if ($body === false) {
            $lastError = error_get_last()['message'] ?? 'Unknown error';
            throw new Exception("Could not reach the Steam Web API. Last error: {$lastError}");
        }

        return $body;
    }
}

/**
 * Wraps download commands in the standard SteamCMD script header.
 */
function formatCommandScript(array $commands) {
    $header = [
        "// Steam Workshop Collection Download Commands",
        "// Generated: " . date('Y-m-d H:i:s'),
        "// Note: Some items may require Steam login",
        "",
        "@ShutdownOnFailedCommand 0",
        "@NoPromptForPassword 1",
        "force_install_dir ./",
        "login anonymous",
        ""
    ];

    return implode("\n", array_merge($header, $commands, ["quit"]));
}

/**
 * Generates commands from a plain list of mod ids and a single app id
 * (used by the Tampermonkey script for subscription pages).
 */
function generateCommandsFromModList($modIds, $appId) {
    if (!is_array($modIds) || !is_numeric($appId) || (int)$appId <= 0) {
        throw new Exception('Invalid mod list or app id');
    }

    $commands = [];
    foreach ($modIds as $modId) {
        if (is_numeric($modId) && $modId > 0) {
            $commands[] = sprintf('workshop_download_item %d %d', $appId, $modId);
        }
    }

    if (empty($commands)) {
        throw new Exception('No valid mod IDs found');
    }

    return formatCommandScript($commands);
}

// Error reporting only in development
if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Request handler
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

if (isset($_POST['modIds']) && isset($_POST['appId'])) {
    // Mod id list from the Tampermonkey script
    try {
        $modIds = json_decode($_POST['modIds']);
        $commands = generateCommandsFromModList($modIds, $_POST['appId']);
        echo json_encode([
            'success' => true,
            'downloadCommands' => $commands
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    // Collection URL from the website form
    $processor = new WorkshopCollectionProcessor();
    echo json_encode($processor->processRequest());
}
