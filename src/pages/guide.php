<?php include '../includes/header.php'; ?>

<div class="guide-section" itemscope itemtype="https://schema.org/HowTo">
    <div class="guide-header">
        <h1 itemprop="name">Complete Workshop Collection Guide</h1>
        <h2 itemprop="description">How to use Steam Workshop mods with any game - Steam and non-Steam versions</h2>
    </div>

    <!-- 1. Introduction & Tools -->
    <div id="introduction" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">1. Introduction & Tools</h2>
            
            <div itemprop="text">
                <!-- What is section -->
                <div class="card sub-card">
                    <h3>What is the SteamCMD Workshop Assistant?</h3>
                    <p>
                        This tool assists you in creating the right SteamCMD commands for Steam Workshop collections. 
                        It makes working with SteamCMD easier by automatically generating the correct command syntax, 
                        particularly helpful when:
                    </p>
                    <ul>
                        <li>Using Workshop mods with games from other platforms (like GOG or EPIC)</li>
                        <li>Setting up modded game servers</li>
                        <li>Managing your Workshop mod collections</li>
                    </ul>

                    <div class="notice-box">
                        <h4>💡 Quick Info</h4>
                        <p>Our assistant creates ready-to-use commands for <a href="#steamcmd-setup">SteamCMD</a> - think of it as your 
                        friendly helper that translates Workshop collections into SteamCMD language! 
                        New to SteamCMD? Check our <a href="#steamcmd-setup">setup guide</a> to get started.</p>
                    </div>
                </div>

                <!-- Why section -->
                <div class="card sub-card">
                    <h3>Why do I need this tool?</h3>
                    <p>
                        The Steam Workshop contains many useful mods, but accessing them without Steam can be complicated. 
                        This assistant helps simplify the process by:
                    </p>

                    <ul class="feature-list">
                        <li>Converting Workshop collection URLs into ready-to-use SteamCMD commands</li>
                        <li>Making mod management easier for games from various platforms</li>
                        <li>Helping server admins organize their mod collections</li>
                    </ul>

                    <div class="notice-box info">
                        <h4>Getting Started</h4>
                        <p>All you need is a Workshop collection URL and SteamCMD installed on your system. 
                        The assistant will handle the command generation for you.</p>
                    </div>
                </div>

                <!-- Tools section -->
                <div class="card sub-card">
                    <h3>Ways to use our tools</h3>
                    <p>Choose the method that works best for you:</p>

                    <div class="tools-grid">
                        <div class="tool-card">
                            <h4>Website</h4>
                            <p>The simplest way to start:</p>
                            <ul>
                                <li>Copy your Workshop collection URL</li>
                                <li>Paste it on our website</li>
                                <li>Get your SteamCMD commands (save as .txt or copy to clipboard)</li>
                            </ul>
                        </div>

                        <div class="tool-card">
                            <h4>TamperMonkey Script</h4>
                            <p>Adds convenience right on Steam pages:</p>
                            <ul>
                                <li>Works directly on Workshop pages</li>
                                <li>Adds a generate button to collections</li>
                                <li>Same output options: save file or copy commands</li>
                            </ul>
                        </div>

                        <div class="tool-card">
                            <h4>Workshop Manager Tool (Alpha, Windows)</h4>
                            <p>Our desktop helper for mod installation:</p>
                            <ul>
                                <li>Simple GUI for SteamCMD setup and configuration</li>
                                <li>Handles mod script execution</li>
                                <li>Lets you choose target directories</li>
                                <li>Optional cleanup and update features</li>
                            </ul>
                            <div class="future-note">
                                <p>📌 Coming in future updates:</p>
                                <ul>
                                    <li>Automatic mod update checking</li>
                                    <li>Enhanced mod management features</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="notice-box">
                        <p>All tools give you the same flexibility: save commands as a text file or copy them directly - 
                        whatever works best for your setup!</p>
                    </div>
                </div>

                <!-- Requirements section -->
                <div class="card sub-card">
                    <h3>What do I need to get started?</h3>
                    <p>Basic requirements for working with Workshop collections:</p>

                    <div class="requirements">
                        <ul>
                            <li>SteamCMD installed on your system (<a href="#steamcmd-setup">setup guide</a>)</li>
                            <li>A Workshop collection URL</li>
                            <li>Disk space for your mods</li>
                        </ul>
                    </div>

                    <div class="notice-box">
                        <h4>Good to know:</h4>
                        <p>Optional but sometimes helpful:</p>
                        <ul>
                            <li>A Steam account - useful for creating collections or in rare cases where anonymous access isn't sufficient</li>
                        </ul>
                        <p>You don't need:</p>
                        <ul>
                            <li>The Steam client</li>
                            <li>The game on Steam</li>
                            <li>Programming knowledge</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- 2. Finding and Organizing Mods -->
    <div id="finding-mods" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">2. Finding and Organizing Mods</h2>
            
            <div itemprop="text">
                <!-- Finding Mods section -->
                <div class="card sub-card">
                    <h3>Finding Workshop Collections</h3>
                    <p>Steam Workshop collections are a great way to keep your mods organized. Here's how to find them:</p>
                
                <ul>
                    <li>Visit the Steam Workshop page for your game</li>
                    <li>Look for the "Collections" tab</li>
                    <li>Browse existing collections or create your own</li>
                </ul>

                <div class="notice-box">
                    <h4>💡 Pro Tip</h4>
                    <p>Many game communities share their collections on forums or Discord servers. 
                    These are often well-tested mod combinations that work great together!</p>
                </div>
                </div>

                <!-- Using Collections section -->
                <div class="card sub-card">
                    <h3>Using Workshop Collections</h3>
                    <p>Once you've found a collection you want to use:</p>
                
                <ol>
                    <li>Copy the collection's URL from your browser</li>
                    <li>Use any of our tools to generate the download commands</li>
                    <li>Follow the SteamCMD instructions to download your mods</li>
                </ol>

                <div class="notice-box info">
                    <h4>URL Format</h4>
                    <p>Collection URLs typically look like this:<br>
                    <code>https://steamcommunity.com/sharedfiles/filedetails/?id=1234567890</code></p>
                </div>
                </div>

                <!-- Tips section -->
                <div class="card sub-card">
                    <h3>Helpful Tips</h3>
                
                    <ul class="feature-list">
                        <li>Make sure all mods in the collection are for the same game</li>
                        <li>Check the collection description for any special instructions</li>
                        <li>Note the required disk space - mod collections can be quite large!</li>
                    </ul>

                    <div class="notice-box">
                        <h4>Good Practice</h4>
                        <p>Before downloading a large collection, check if it's still maintained and 
                        compatible with your game version.</p>
                    </div>
                </div>
            </div>

<!-- Installation Basics section -->
<div class="card sub-card">
    <h3>Understanding Mod Installation</h3>
    <p>After downloading mods, they need to be placed in the correct game folder:</p>
    
    <ul class="feature-list">
        <li>Each game has its own specific mod folder structure</li>
        <li>The location and setup can vary significantly between games</li>
        <li>Some games require additional mod tools or launchers</li>
    </ul>

    <div class="notice-box info">
        <h4>Where to Find Help</h4>
        <p>To find the correct mod folder and installation steps:</p>
        <ul>
            <li>Check the game's official documentation or forums</li>
            <li>Look for modding guides in the game's community hub</li>
            <li>Join the game's modding Discord or community forums</li>
        </ul>
    </div>

    <div class="notice-box">
        <h4>💡 Good to Know</h4>
        <p>Game developers often provide modding guidelines or tools. 
        The modding community is usually very helpful in sharing setup guides and troubleshooting tips!</p>
    </div>
</div>

                <!-- Windows App section -->
                <div class="card sub-card">
    <h3>Simplified Mod Installation with our Windows App</h3>
    <p>While SteamCMD downloads mods in a specific Steam folder structure, our Windows App helps automate the installation process:</p>

    <div class="notice-box info">
        <h4>How it works:</h4>
        <ul>
            <li>SteamCMD downloads mods using its own folder structure (e.g., steamapps/workshop/content/[GameID]/[ModID]/...)</li>
            <li>Our Windows App automatically recognizes this structure</li>
            <li>It copies the actual mod content to your game's mod folder</li>
            <li>The result is a clean, game-ready mod folder structure</li>
        </ul>
    </div>

    <div class="example-box">
        <h4>Example:</h4>
        <p>SteamCMD structure:</p>
        <code>steamapps/workshop/content/108600/2699828474/mods/Rebalanced Prop Moving/...</code>
        
        <p>Becomes:</p>
        <code>YourGame/Mods/Rebalanced Prop Moving/...</code>
    </div>

    <div class="notice-box">
        <h4>💡 Advantage</h4>
        <p>No need to manually navigate through Steam's folder structure or move files around - 
        our app handles the reorganization automatically!</p>
    </div>
</div>
            </div>
        </div>
    

    <!-- 3. SteamCMD Setup -->
<!-- 3. SteamCMD Setup -->
<div id="steamcmd-setup" class="card main-card">
    <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
        <h2 itemprop="name">3. Using Generated Scripts with SteamCMD</h2>
        
        <div itemprop="text">
            <!-- Script Overview -->
            <div class="card sub-card">
                <h3>Understanding Your Generated Script</h3>
                <p>Our tools generate a ready-to-use script file containing all necessary commands. Let's look at what's included:</p>

                <div class="code-example">
                    <code>
                        @ShutdownOnFailedCommand 0    // Continues even if one download fails<br>
                        @NoPromptForPassword 1        // No password prompts<br>
                        force_install_dir ./          // Uses current directory<br>
                        login anonymous               // Anonymous login<br>
                        workshop_download_item ...    // Your mod downloads
                    </code>
                </div>

                <div class="notice-box info">
                    <h4>💡 Quick Start</h4>
                    <p>Simply save the generated file as "workshop_downloads.txt" in your SteamCMD folder.</p>
                </div>
            </div>

            <!-- Using the Script -->
            <div class="card sub-card">
                <h3>Running Your Download Script</h3>
                <ol>
                    <li>Install SteamCMD from the official 
                        <a href="https://developer.valvesoftware.com/wiki/SteamCMD" target="_blank">Valve Developer Community</a>
                    </li>
                    <li>Place your generated script file in the SteamCMD folder</li>
                    <li>Open command prompt/terminal in that folder</li>
                    <li>Run: <code>steamcmd +runscript workshop_downloads.txt</code></li>
                </ol>

                <div class="notice-box">
                    <h4>Progress Tracking</h4>
                    <p>SteamCMD will show download progress for each mod in your collection.</p>
                </div>
            </div>

            <!-- Common Script Options -->
            <div class="card sub-card">
                <h3>Included Script Features</h3>
                <ul>
                    <li>✅ Automatic anonymous login</li>
                    <li>✅ Continues if single downloads fail</li>
                    <li>✅ Download verification included</li>
                    <li>✅ No manual commands needed</li>
                </ul>

                <div class="notice-box info">
                    <h4>Need More Options?</h4>
                    <p>For advanced SteamCMD usage and options, check the 
                    <a href="https://developer.valvesoftware.com/wiki/SteamCMD" target="_blank">official documentation</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Workshop Assistant App -->
<div id="workshop-assistant" class="card main-card">
    <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
        <h2 itemprop="name">4. SteamCMD Workshop Assistant</h2>
        
        <div itemprop="text">
            <!-- App Overview -->
            <div class="card sub-card">
                <h3>About Workshop Assistant</h3>
                <p>The SteamCMD Workshop Assistant is our Windows application that helps make mod installation easier. 
                It provides a simple interface for working with SteamCMD and managing your Workshop downloads.</p>

                <!-- Screenshot -->
                <div class="app-preview">
                    <img src="/includes/images/SteamCMD_Workshop_Assistant.png" alt="Workshop Assistant Interface" class="app-screenshot">
                    <p class="caption">The Workshop Assistant's main window</p>
                </div>

                <div class="notice-box info">
                    <h4>💡 Community Project</h4>
                    <p>The Workshop Assistant will be released as open-source software, allowing everyone 
                    to help improve it and adapt it to their needs.</p>
                </div>
            </div>

            <!-- Features -->
            <div class="card sub-card">
                <h3>What it does</h3>
                <ul class="feature-list">
                    <li>🎮 Makes mod installation more straightforward</li>
                    <li>📊 Shows you download progress</li>
                    <li>📝 Keeps track of what's happening</li>
                    <li>🧹 Can clean up old files if you want</li>
                    <li>⚙️ Lets you adjust SteamCMD settings</li>
                    <li>⏹️ Allows stopping downloads when needed</li>
                </ul>
            </div>

            <!-- Requirements -->
            <div class="card sub-card">
                <h3>What you need to run it</h3>
                <ul>
                    <li>A 64-bit Windows PC</li>
                    <li>.NET 8.0 Runtime (we'll provide a download link)</li>
                    <li>SteamCMD installed</li>
                    <li>Enough space for your mods</li>
                </ul>

                <div class="notice-box">
                    <h4>Getting Started</h4>
                    <p>Download links and setup instructions will be available soon!</p>
                </div>
            </div>

            <!-- License Info -->
            <div class="card sub-card">
                <h3>Usage Rights</h3>
                <p>The Workshop Assistant will be free to use under the Creative Commons Attribution-NonCommercial License:</p>
                <ul>
                    <li>✅ Free to use</li>
                    <li>✅ OK to modify for your needs</li>
                    <li>✅ Can be shared with others</li>
                    <li>❌ Not for commercial use</li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <!-- Help and Support -->
    <div id="support" class="card">
        <h2>Need More Help?</h2>
        <div class="support-options">
            <p>Check our <a href="faq.php">FAQ</a> for quick answers</p>
            <p>Or use the <a href="#" id="openFeedbackPopup">feedback form</a> for specific questions</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
