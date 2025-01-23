<?php
define('PAGE_SCRIPTS', ['/js/form.js']); 
include '../includes/header.php';
?>

<div class="download-guide" itemscope itemtype="https://schema.org/HowTo">
    <h1 itemprop="name">Download Steam Workshop Collections</h1>

    <!-- New Workshop Manager Section -->
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
            <div class="feature">
                <h3>Open Source</h3>
                <p>The code ist already on GitHub. The repository is still private and wil changed to public when an acceptable code base is ready.</p>
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
    
    <div class="card">
        <button id="openTampermonkeyPopup" class="btn mb-6 flex items-center justify-center mx-auto gap-2">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                <polyline points="13 2 13 9 20 9"></polyline>
            </svg>
            Available as TamperMonkey Script with additional features
        </button>
    </div>
    
    <div class="card">
        <form id="collectionForm" class="form-group">
            <label for="collectionURL">Enter Steam Workshop Collection URL:</label>
            <input type="text" id="collectionURL" name="collectionURL" required 
                   placeholder="https://steamcommunity.com/sharedfiles/filedetails/?id=...">
            <div id="infoFeedback" class="feedback-info"></div>
            <div id="errorFeedback" class="feedback-error"></div>
            <button type="submit" class="btn">Generate Commands</button>
        </form>
    </div>

    <div id="extractedModIdsAndCommands" class="card" style="display: none;">
        <h2>Generated Commands</h2>
        <div class="form-group">
            <label>Command list:</label>
            <textarea id="downloadCommands" readonly rows="10"></textarea>
        </div>
        <div class="button-group">
            <button class="btn">Download SteamCMD commands file</button>
            <button class="btn">Copy to Clipboard</button>
        </div>
    </div>
</div>

<!-- TamperMonkey Scripts Popup -->
<div id="tampermonkeyPopup" class="feedback-popup">
    <div class="feedback-popup-content">
        <span class="close-button">&times;</span>
        <h2>TamperMonkey Script</h2>
        
        <!-- Combined Script -->
        <div class="form-group">
            <h4>Steam Workshop Downloader Script</h4>
            <p>This script adds convenient download functionality to:</p>
            <ul class="feature-list mb-4">
                <li>Steam Workshop collection pages</li>
                <li>Your personal Workshop subscriptions page</li>
            </ul>
            <p class="mb-4">The script will automatically add a "Generate Download Commands" button to these pages.</p>
            <a href="/downloads/collection-downloader.user.js" 
               class="btn">Download Script</a>
        </div>

        <!-- Requirements & Info -->
        <div class="form-group mt-6">
            <h4>Requirements</h4>
            <ul class="mb-4">
                <li>TamperMonkey browser extension installed</li>
                <li>Steam Workshop account (for personal subscriptions)</li>
            </ul>
            <a href="faq.php#tampermonkey-scripts" class="btn">
                Learn more in our FAQ
            </a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
