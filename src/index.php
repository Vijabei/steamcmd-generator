<?php include 'includes/header.php'; ?>

<div class="hero">
    <h1>Steam Workshop Collection Downloader</h1>
    <p class="lead">Download complete mod collections easily with SteamCMD</p>
    <a href="./pages/collection-download.php" class="btn">Start Download</a>
</div>

<!-- New Workshop Manager Announcement -->
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
        <a href="./downloads/WorkshopManager.zip" class="btn">Download Workshop Manager</a>
        <a href="./pages/collection-download.php#workshop-manager" class="btn btn-secondary">Learn More</a>
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
            <li>Paste the URL and generate commands</li>
            <li>Download the SteamCMD command file</li>
            <li>Use with SteamCMD to download all mods</li>
        </ol>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
