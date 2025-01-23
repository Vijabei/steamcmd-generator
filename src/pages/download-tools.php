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
    <p>Enhance Steam Workshop pages with direct command generation:</p>
    
    <!-- Direct Install Button -->
    <a href="/downloads/collection-downloader.user.js" class="btn mb-6 flex items-center justify-center mx-auto gap-2">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
            <polyline points="13 2 13 9 20 9"></polyline>
        </svg>
        Install TamperMonkey Script
    </a>
    <p class="text-center text-sm mb-4">(Will automatically open TamperMonkey for installation if you have it installed)</p>
    
    <!-- More Info Button -->
    <button id="openTampermonkeyPopup" class="btn btn-secondary">
        Learn More About Features
    </button>
</div>

<!-- TamperMonkey Scripts Popup -->
<div id="tampermonkeyPopup" class="feedback-popup">
    <div class="feedback-popup-content">
        <span class="close-button">&times;</span>
        <h2>TamperMonkey Script Features</h2>
        
        <!-- Script Features -->
        <div class="form-group">
            <h4>What This Script Does</h4>
            <p>This script adds convenient download functionality to:</p>
            <ul class="feature-list mb-4">
                <li>Steam Workshop collection pages</li>
                <li>Your personal Workshop subscriptions page</li>
            </ul>
            <p class="mb-4">The script will automatically add a "Generate Download Commands" button to these pages.</p>
            
            <!-- Direct Install Button in Popup -->
            <a href="/downloads/collection-downloader.user.js" 
               class="btn">Install Script Now</a>
        </div>

        <!-- Requirements & Info -->
        <div class="form-group mt-6">
            <h4>Requirements</h4>
            <ul class="mb-4">
                <li>TamperMonkey browser extension installed</li>
                <li>Steam Workshop account (for personal subscriptions)</li>
            </ul>
            
            <h4>Installation Steps</h4>
            <ol class="mb-4">
                <li>Install the TamperMonkey browser extension if you haven't already</li>
                <li>Click the "Install Script" button above</li>
                <li>TamperMonkey will automatically open the installation page</li>
                <li>Click "Install" in TamperMonkey to complete the installation</li>
            </ol>
            
            <a href="faq.php#tampermonkey-scripts" class="btn btn-secondary">
                View FAQ & Troubleshooting
            </a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>