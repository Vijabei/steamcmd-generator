<?php
define('PAGE_SCRIPTS', ['/js/form.js']); 
include '../includes/header.php';
?>

<div class="command-generator" itemscope itemtype="https://schema.org/SoftwareApplication">
    <h1 itemprop="name">Generate Workshop Download Commands</h1>
    <p class="lead">Generate SteamCMD commands for your Workshop collections</p>

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

    <div id="extractedModIdsAndCommands" class="card">
        <h2>Generated Commands</h2>
        <div class="form-group">
            <label for="downloadCommands">Command list:</label>
            <textarea id="downloadCommands" 
                      readonly 
                      rows="10"
                      aria-label="Generated SteamCMD commands"
                      autocomplete="off"
                      spellcheck="false"></textarea>
        </div>
        <div class="button-group">
            <button class="btn">Download SteamCMD commands file</button>
            <button class="btn">Copy to Clipboard</button>
        </div>
    </div>
    
    <div class="card">
        <h2>Next Steps</h2>
        <p>After generating your commands, choose your preferred installation method:</p>
        
        <div class="options-container">
            <div class="option-item">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                <p>Use the Workshop Manager app - it can import this command file, or skip this page entirely and resolve your collection itself</p>
                <a href="download-tools.php#workshop-manager" class="btn">Get Workshop Manager</a>
            </div>

            <div class="option-divider">
                <span>or</span>
            </div>

            <div class="option-item">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
                <p>Use the commands directly with SteamCMD if you prefer command line</p>
                <a href="guide.php#steamcmd-setup" class="btn">SteamCMD Guide</a>
            </div>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>