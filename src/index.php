<?php include 'includes/header.php'; ?>

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
    <h2>NEW: Workshop Manager Tool</h2>
    <p>We're excited to introduce our new Workshop Manager - a graphical tool that makes downloading and managing your Steam Workshop mods even easier!</p>
    <ul class="feature-list">
        <li>Simple graphical interface for SteamCMD operations</li>
        <li>Automatic mod installation handling</li>
        <li>Direct integration with our command generator</li>
        <li>Easy path configuration for SteamCMD and target directories</li>
    </ul>
    <div class="button-group">
        <a href="./pages/download-tools.php#workshop-manager" class="btn">Get Workshop Manager</a>
        <a href="./pages/setup-guide.php" class="btn btn-secondary">Learn More</a>
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