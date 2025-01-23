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
    
    <div class="card">
        <h2>Next Steps</h2>
        <p>After generating your commands:</p>
        <ol>
            <li>Download our Workshop Manager tool for easy mod installation</li>
            <li>Or use the commands directly with SteamCMD</li>
        </ol>
        <div class="button-group">
            <a href="download-tools.php" class="btn">Get Workshop Manager</a>
            <a href="setup-guide.php" class="btn btn-secondary">View Setup Guide</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>