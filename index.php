<?php
define('PAGE_DESCRIPTION', 'Free tools to download complete Steam Workshop collections with SteamCMD - web generator, Windows mod manager with one-click installs, and a browser script. No Steam client needed.');
include 'includes/header.php';
?>

<div class="hero">
    <h1>Steam Workshop Collection Downloader</h1>
    <p class="lead">Generate commands and download complete mod collections easily with SteamCMD</p>
    <div class="button-group">
        <a href="./pages/generate-commands.php" class="btn">Generate Commands</a>
        <a href="./pages/download-tools.php" class="btn btn-secondary">Download Tools</a>
    </div>
</div>

<!-- Workshop Manager Announcement -->
<div class="card announcement">
    <h2><?php echo $release['announcement']['title']; ?></h2>
    <p><?php echo $release['announcement']['lead']; ?></p>
    <ul class="feature-list">
<?php foreach ($release['announcement']['items'] as $item): ?>
        <li><?php echo $item; ?></li>
<?php endforeach; ?>
    </ul>
    <div class="button-group">
        <a href="./pages/download-tools.php#workshop-manager" class="btn">Get Workshop Manager</a>
        <a href="./pages/guide.php#mod-manager-details" class="btn btn-secondary">Learn More</a>
    </div>
</div>

<div class="grid grid-2">
    <div class="card">
        <h2>Features</h2>
        <ul class="feature-list">
            <li>Download complete mod collections at once</li>
            <li>Perfect for game servers and non-Steam games</li>
            <li>Works with EPIC Store, GOG.com and game servers</li>
            <li>Simple and free to use</li>
        </ul>
    </div>
    
    <div class="card">
        <h2>Quick Start</h2>
        <ol class="quick-start">
            <li>Copy your Steam Workshop Collection URL</li>
            <li>Generate SteamCMD commands</li>
            <li>Use Workshop Manager or SteamCMD to download mods</li>
            <li>Install mods in your game directory</li>
        </ol>
    </div>
</div>

<?php include 'includes/footer.php'; ?>