<?php include '../includes/header.php'; ?>

<div class="guide-section" itemscope itemtype="https://schema.org/HowTo">
    <h1 itemprop="name">Workshop Collection Guide</h1>
    <h2 itemprop="description">Complete guide to Steam Workshop collections, setup, and tools</h2>

    <!-- Workshop Collections -->
    <div id="collections" class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">Creating and Managing Collections</h2>
            
            <div itemprop="text">
                <h3>Creating a Collection</h3>
                <ol>
                    <li>Open Steam and log into your account</li>
                    <li>Navigate to the Steam Workshop</li>
                    <li>Click on your profile name</li>
                    <li>Select "Collections" from the dropdown</li>
                    <li>Click "Create Collection"</li>
                    <li>Give your collection a name and description</li>
                    <li>Choose visibility (public/private)</li>
                    <li>Click "Save Collection"</li>
                </ol>

                <h3>Adding Mods to Your Collection</h3>
                <ol>
                    <li>Browse the Workshop for mods you want</li>
                    <li>On each mod page, click "Add to Collection"</li>
                    <li>Select your collection from the dropdown</li>
                    <li>Optionally, rearrange mods in your collection</li>
                    <li>Save changes to update your collection</li>
                </ol>

                <div class="notice-box">
                    <h4>Best Practices</h4>
                    <ul>
                        <li>Create separate collections for different mod categories</li>
                        <li>Consider load order when arranging mods</li>
                        <li>Test your mod combinations before sharing</li>
                        <li>Back up your collection URLs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- SteamCMD Setup -->
    <div id="steamcmd-setup" class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">Setting Up SteamCMD</h2>
            
            <div itemprop="text">
                <h3>Installation Steps</h3>
                <ol>
                    <li>Download SteamCMD for your operating system:
                        <ul>
                            <li>Windows: Download steamcmd.zip from Valve's website</li>
                            <li>Linux: Use package manager or download directly</li>
                        </ul>
                    </li>
                    <li>Extract to desired directory</li>
                    <li>Run steamcmd.exe (Windows) or ./steamcmd.sh (Linux)</li>
                    <li>Wait for initial update to complete</li>
                </ol>

                <div class="notice-box">
                    <h4>Important Requirements</h4>
                    <ul>
                        <li>Sufficient disk space for workshop content</li>
                        <li>Stable internet connection</li>
                        <li>Required permissions for installation directory</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Command Usage -->
    <div id="command-usage" class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">Using Workshop Commands</h2>
            
            <div itemprop="text">
                <h3>Basic Usage</h3>
                <ol>
                    <li>Generate commands using our tool</li>
                    <li>Save the command file in your SteamCMD directory</li>
                    <li>Run SteamCMD</li>
                    <li>Execute: +runscript steamcmd_commands.txt</li>
                    <li>Wait for downloads to complete</li>
                </ol>

                <div class="notice-box">
                    <h4>Tips</h4>
                    <ul>
                        <li>Use anonymous login for public content</li>
                        <li>Some items may require Steam login</li>
                        <li>Keep SteamCMD updated</li>
                        <li>Check game-specific mod installation paths</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- TamperMonkey -->
    <div id="tampermonkey" class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">TamperMonkey Script Setup</h2>
            
            <div itemprop="text">
                <h3>Installation Steps</h3>
                <ol>
                    <li>Install the TamperMonkey browser extension</li>
                    <li>Visit our Download Tools page</li>
                    <li>Click "Install TamperMonkey Script"</li>
                    <li>Confirm the installation in TamperMonkey</li>
                </ol>

                <h3>Using the Script</h3>
                <ol>
                    <li>Visit any Steam Workshop collection or your subscriptions page</li>
                    <li>Look for the new "Generate Download Commands" button</li>
                    <li>Click to generate commands directly on the Steam page</li>
                    <li>Use the commands with SteamCMD or Workshop Manager</li>
                </ol>

                <div class="notice-box">
                    <h4>Features</h4>
                    <ul>
                        <li>Direct command generation on Steam pages</li>
                        <li>Support for collections and personal subscriptions</li>
                        <li>Automatic game ID detection</li>
                        <li>Easy command copying and downloading</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Troubleshooting -->
    <div id="troubleshooting" class="card">
        <h2>Troubleshooting</h2>
        
        <h3>Common Issues</h3>
        <div class="troubleshooting-grid">
            <div class="issue-card">
                <h4>Download Fails</h4>
                <ul>
                    <li>Verify internet connection</li>
                    <li>Check available disk space</li>
                    <li>Try with Steam login if required</li>
                    <li>Update SteamCMD</li>
                </ul>
            </div>

            <div class="issue-card">
                <h4>Access Denied</h4>
                <ul>
                    <li>Check folder permissions</li>
                    <li>Run as administrator (Windows)</li>
                    <li>Verify Steam account access</li>
                </ul>
            </div>

            <div class="issue-card">
                <h4>Missing Files</h4>
                <ul>
                    <li>Verify download completion</li>
                    <li>Check installation paths</li>
                    <li>Look for error messages in log</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Non-Steam Games -->
    <div id="non-steam" class="card">
        <h2>Using with Non-Steam Games</h2>
        
        <div class="platform-support">
            <h3>Supported Platforms</h3>
            <ul>
                <li>EPIC Games Store</li>
                <li>GOG.com</li>
                <li>Dedicated game servers</li>
                <li>Other platforms with SteamCMD support</li>
            </ul>

            <h3>Setup Process</h3>
            <ol>
                <li>Install game on your preferred platform</li>
                <li>Set up SteamCMD as normal</li>
                <li>Download Workshop content</li>
                <li>Copy files to game's mod directory</li>
                <li>Follow game-specific mod installation instructions</li>
            </ol>

            <div class="notice-box">
                <h4>Important Notes</h4>
                <ul>
                    <li>Verify mod compatibility with your game version</li>
                    <li>Check game documentation for mod folder structure</li>
                    <li>Some mods may require additional setup</li>
                    <li>Keep backups of original game files</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>