<?php
define('PAGE_SCRIPTS', ['/js/feedback.js']); 
include '../includes/header.php';
?>

<div class="download-tools" itemscope itemtype="https://schema.org/SoftwareApplication">
    <h1 itemprop="name">Workshop Download Tools</h1>
    <p class="lead">Choose the tool that best fits your needs</p>

    <!-- Workshop Manager Section -->
    <div class="card" id="workshop-manager">
        <h2>Workshop Manager 1.0</h2>
        <p>The complete mod manager for Steam Workshop content - browse, pick and install without touching a command line:</p>
        <div class="tool-features">
            <div class="feature">
                <h3>Built-in Workshop Browser</h3>
                <p>Browse the Steam Workshop inside the app and import collections or your subscribed items with one click</p>
            </div>
            <div class="feature">
                <h3>All-in-one Installation</h3>
                <p>Resolves collections via the official Steam Web API, sets up SteamCMD for you and installs mods in batches with automatic retries</p>
            </div>
            <div class="feature">
                <h3>Keeps You Up to Date</h3>
                <p>Shows mod titles, sizes and update status, skips what is already installed and detects available updates</p>
            </div>
        </div>
        <div class="download-section">
            <a href="https://github.com/Vijabei/SteamWorkshopManager/releases/latest" target="_blank" rel="noopener" class="btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Download Workshop Manager (GitHub)
            </a>
            <p class="version-info">Version 1.0.0 - Windows 64-bit - free &amp; open source (CC BY-NC 4.0)</p>
            <p class="version-info">Requires the <a href="https://dotnet.microsoft.com/download/dotnet/8.0" target="_blank" rel="noopener">.NET 8.0 Desktop Runtime</a>. SteamCMD is downloaded by the app itself.</p>
        </div>
    </div>
    
<!-- TamperMonkey Section -->
<div class="card">
    <h2>TamperMonkey Script</h2>
    <p class="mb-6">Adds a command-generation button directly on Steam Workshop pages - for collections and for your personal subscription list.</p>
    <p class="mb-6">Ideal if you are on <strong>Linux or macOS</strong>, or prefer working in your browser instead of installing the Workshop Manager app. Version 1.5.0 works with every Steam interface language and updates itself automatically from this site.</p>
    
    <div class="tampermonkey-actions flex flex-col items-center gap-4">
        <!-- Direct Install Button -->
        <a href="/downloads/collection-downloader.user.js" class="btn w-full max-w-md flex items-center justify-center gap-2">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                <polyline points="13 2 13 9 20 9"></polyline>
            </svg>
            Install TamperMonkey Script
        </a>
        <p class="text-sm text-center">Will automatically open TamperMonkey for installation</p>
        
        <div class="flex gap-4 mt-4">
            <a href="guide.php#tampermonkey" class="btn btn-secondary">Guide</a>
            <a href="faq.php#tampermonkey" class="btn btn-secondary">FAQ</a>
        </div>
    </div>
</div>

<!-- TamperMonkey Scripts Popup - Removed as functionality moved to guide page -->

<?php include '../includes/footer.php'; ?>