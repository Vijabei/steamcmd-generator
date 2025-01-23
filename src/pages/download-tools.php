<?php
define('PAGE_SCRIPTS', ['/js/feedback.js']); 
include '../includes/header.php';
?>

<div class="download-tools" itemscope itemtype="https://schema.org/SoftwareApplication">
    <h1 itemprop="name">Workshop Download Tools</h1>
    <p class="lead">Choose the tool that best fits your needs</p>

    <!-- Workshop Manager Section -->
    <div class="card" id="workshop-manager">
        <h2>Workshop Manager Tool</h2>
        <p>Simplify your mod management with our new graphical Workshop Manager tool:</p>
        <div class="tool-features">
            <div class="feature">
                <h3>Easy Setup</h3>
                <p>Configure SteamCMD paths and target directories with a simple interface</p>
            </div>
            <div class="feature">
                <h3>Automatic Installation</h3>
                <p>Just paste your commands and let the tool handle the rest</p>
            </div>
            <div class="feature">
                <h3>Progress Tracking</h3>
                <p>Monitor download and installation progress in real-time</p>
            </div>
        </div>
        <div class="download-section">
            <a href="../downloads/WorkshopManager.zip" class="btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Download Workshop Manager
            </a>
            <p class="version-info">Version 1.0 - Windows executable</p>
        </div>
    </div>
    
<!-- TamperMonkey Section -->
<div class="card">
    <h2>TamperMonkey Script</h2>
    <p class="mb-6">Enhance Steam Workshop pages with direct command generation capability.</p>
    
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