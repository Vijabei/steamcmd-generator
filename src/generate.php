<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    $allowedOrigins = array(
        'https://steamcommunity.com',
        'https://softknight.de'
    );
    if (in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Methods: POST, GET');
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    }
}

function logButtonClick($type = 'download', $source = 'web') {
    $logDir = __DIR__ . '/logs';
    $logFile = $logDir . '/user_interactions.log';
    
    // Create log directory if it doesn't exist
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    // Build log entry with more information
    $logEntry = sprintf(
        "[%s] Action: %s, Source: %s, IP: %s, UA: %s\n",
        date('Y-m-d H:i:s'),
        $type,
        $source,
        $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    );
    
    if (@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
        error_log("Failed to write to interaction log file: " . $logFile);
    }
}

// Modified click counter handler
if (isset($_GET['countButtonClick'])) {
    $type = $_GET['type'] ?? 'download';
    $source = $_GET['source'] ?? 'web';
    logButtonClick($type, $source);
    exit;
}

class WorkshopCollectionProcessor {
    private $logFile;
    private $maxRetries = 3;
    private $userAgent = 'Mozilla/5.0 (compatible; Workshop Collection Helper/2.0)';
    
    public function __construct() {
        // Definiere Log-Verzeichnis relativ zum Skript-Verzeichnis
        $logDir = __DIR__ . '/logs';
        $this->logFile = $logDir . '/collection_logs.txt';
        
        // Erstelle Log-Verzeichnis falls nicht vorhanden
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        // Prüfe ob Log-Datei existiert und schreibbar ist
        if (!file_exists($this->logFile)) {
            touch($this->logFile);
            chmod($this->logFile, 0644);
        }
    }

    private function logAccess($url) {
        $logEntry = sprintf(
            "[%s] Collection processed: %s (IP: %s, UA: %s)\n",
            date('Y-m-d H:i:s'),
            $url,
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
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
            $steamCmdCommands = $this->processCollection($collectionURL);
            
            $this->logAccess($collectionURL);
            
            return [
                'success' => true,
                'downloadCommands' => $this->formatCommands($steamCmdCommands)
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    private function getValidatedURL($url) {
        // Bereinige die URL
        $url = filter_var(trim($url), FILTER_SANITIZE_URL);
        
        // Füge https:// hinzu wenn nötig
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'https://' . $url;
        }
        
        // Validiere URL-Format
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL format');
        }
        
        // Prüfe Steam Workshop URL-Pattern
        $pattern = '#^https://steamcommunity\.com/sharedfiles/filedetails/\?id=\d+$#';
        if (!preg_match($pattern, $url)) {
            throw new Exception('Invalid Steam Workshop Collection URL format. Example: https://steamcommunity.com/sharedfiles/filedetails/?id=123456789');
        }
        
        return $url;
    }
    
    private function processCollection($url) {
        $html = $this->fetchURL($url);
        
        // Extrahiere Game ID - Verwende ein sichereres Pattern
        $appIdPattern = '#data-appid=["\']?(\d+)["\']?#';
        if (!preg_match($appIdPattern, $html, $matches)) {
            throw new Exception('Could not extract game ID from collection');
        }
        $gameId = $matches[1];
        
        // Extrahiere Mod IDs - Verwende ein sichereres Pattern
        $modPattern = '#sharedfile_(\d+)#';
        if (!preg_match_all($modPattern, $html, $matches)) {
            throw new Exception('No mod IDs found in collection');
        }
        $modIds = array_unique($matches[1]); // Entferne Duplikate direkt hier
        
        if (empty($modIds)) {
            throw new Exception('Collection appears to be empty');
        }
        
        return $this->generateCommands($gameId, $modIds);
    }
    
    private function fetchURL($url) {
        $options = [
            'http' => [
                'user_agent' => $this->userAgent,
                'timeout' => 30,
                'follow_location' => 1,
                'ignore_errors' => true,
                'header' => [
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language: en-US,en;q=0.5'
                ]
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true
            ]
        ];
        
        $context = stream_context_create($options);
        
        $retries = 0;
        $lastError = '';
        
        while ($retries < $this->maxRetries) {
            $html = @file_get_contents($url, false, $context);
            
            if ($html !== false) {
                return $html;
            }
            
            $lastError = error_get_last()['message'] ?? 'Unknown error';
            $retries++;
            
            if ($retries < $this->maxRetries) {
                sleep(1); // Kurze Pause zwischen Versuchen
            }
        }
        
        throw new Exception("Could not fetch collection data after {$this->maxRetries} attempts. Last error: {$lastError}");
    }
    
    private function generateCommands($gameId, $modIds) {
        // Validiere die IDs nochmal zur Sicherheit
        if (!is_numeric($gameId) || $gameId <= 0) {
            throw new Exception('Invalid game ID');
        }
        
        $commands = [];
        foreach ($modIds as $modId) {
            if (is_numeric($modId) && $modId > 0) {
                $commands[] = sprintf('workshop_download_item %d %d', $gameId, $modId);
            }
        }
        
        if (empty($commands)) {
            throw new Exception('No valid mod IDs found');
        }
        
        return $commands;
    }
    
    private function formatCommands($commands) {
        $header = [
            "// Steam Workshop Collection Download Commands",
            "// Generated: " . date('Y-m-d H:i:s'),
            "// Note: Some collections may require Steam login",
            "",
            "@ShutdownOnFailedCommand 0",
            "@NoPromptForPassword 1",
            "force_install_dir ./",
            "login anonymous",
            "bVerifyAllDownloads 1",
            ""
        ];
        
        return implode("\n", array_merge($header, $commands));
    }
    
    }
    
// Neue Hilfsfunktion für Mod-Listen
function generateCommandsFromModList($modIds, $appId) {
    $header = [
        "// Steam Workshop Collection Download Commands",
        "// Generated: " . date('Y-m-d H:i:s'),
        "// Note: Some items may require Steam login",
        "",
        "@ShutdownOnFailedCommand 0",
        "@NoPromptForPassword 1",
        "force_install_dir ./",
        "login anonymous",
        "bVerifyAllDownloads 1",
        ""
    ];
    
    $commands = [];
    foreach ($modIds as $modId) {
        if (is_numeric($modId) && $modId > 0) {
            $commands[] = sprintf('workshop_download_item %d %d', $appId, $modId);
        }
    }
    
    if (empty($commands)) {
        throw new Exception('No valid mod IDs found');
    }
    
    return implode("\n", array_merge($header, $commands));
}    

// Aktiviere Fehlerberichterstattung nur für Entwicklung
if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Request Handler
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

// Neue Verzweigung für die verschiedenen Input-Typen
if (isset($_POST['modIds']) && isset($_POST['appId'])) {
    // Verarbeite Liste von Mod-IDs
    $modIds = json_decode($_POST['modIds']);
    $appId = $_POST['appId'];
    $commands = generateCommandsFromModList($modIds, $appId);
    echo json_encode([
        'success' => true,
        'downloadCommands' => $commands
    ]);
} else {
    // Bisherige Verarbeitung
    $processor = new WorkshopCollectionProcessor();
    echo json_encode($processor->processRequest());
}
