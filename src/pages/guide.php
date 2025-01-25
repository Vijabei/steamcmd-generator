<?php include '../includes/header.php'; ?>

<div class="guide-section" itemscope itemtype="https://schema.org/HowTo">
    <div class="guide-header">
        <h1 itemprop="name">Complete Workshop Collection Guide</h1>
        <h2 itemprop="description">How to use Steam Workshop mods with any game - Steam and non-Steam versions</h2>
    </div>

    <div class="guide-nav">
    <div class="step-overview">
        <div class="step active" data-step="1">
            <span class="step-number">1</span>
            <span class="step-title">Introduction & Tools</span>
        </div>
        <div class="step" data-step="2">
            <span class="step-number">2</span>
            <span class="step-title">Finding & Organizing</span>
        </div>
        <div class="step" data-step="3">
            <span class="step-number">3</span>
            <span class="step-title">Using Scripts</span>
        </div>
        <div class="step" data-step="4">
            <span class="step-number">4</span>
            <span class="step-title">Mod Manager</span>
        </div>
    </div>
</div>

    <!-- 1. Introduction & Tools -->
    <div id="introduction" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">1. Introduction & Tools</h2>
            
            <div itemprop="text">
                <!-- What is section -->
                <div class="card sub-card">
                    <h3>What are the SteamCMD Workshop Assistants?</h3>
                    <p>
                        We offer two main tools to help you work with Steam Workshop collections:
                    </p>
                    <ul>
                        <li>The BatchFile Generator (website and TamperMokey Script) for creating SteamCMD commands</li>
                        <li>The Workshop Mod Manager for automated downloads and installation</li>
                    </ul>
                    <br>
                    <p>
                        These tools are particularly helpful when:
                    </p>
                    <ul>
                        <li>Using Workshop mods with games from other platforms (like GOG or EPIC)</li>
                        <li>Setting up modded game servers</li>
                        <li>Managing your Workshop mod collections</li>
                    </ul>

                    <div class="notice-box">
                        <h4>💡 Quick Info</h4>
                        <p>Start with our BatchFile Generator to create your download commands. Our assistants create ready-to-use commands for <a href="#steamcmd-setup">SteamCMD</a> - think of it as your 
                        friendly helper that translates Workshop collections into SteamCMD language! 
                        New to this process? Check our <a href="#steamcmd-setup">setup guide</a> to get started.</p>
                    </div>
                </div>

                <!-- Why section -->
                <div class="card sub-card">
                    <h3>Why do you need these tools?</h3>
                    <p>
                        The Steam Workshop contains many useful mods, but accessing them without Steam can be complicated. 
                        These assistants help simplify this process:
                    </p>

                    <ul class="feature-list">
                        <li>The BatchFile Generator creates the correct SteamCMD commands automatically</li>
                        <li>The Workshop Mod Manager helps with downloading and installing the mods</li>
                        <li>Together, they make mod management easier for any platform</li>
                    </ul>

                    <div class="notice-box info">
                        <h4>Getting Started</h4>
                        <p>Begin with the BatchFile Generator - all you need is a Workshop collection URL. 
                        The generator will create the commands you need.</p>
                    </div>
                </div>

                <!-- Tools section -->
                <div class="card sub-card">
                    <h3>Ways to Generate SteamCMD Commands</h3>
                    <p>Choose the method that works best for you to create your download commands:</p>

                    <div class="tools-grid">
                        <div class="tool-card">
                            <h4>BatchFile Generator Website</h4>
                            <p>The simplest way to start:</p>
                            <ul>
                                <li>Copy your Workshop collection URL</li>
                                <li>Paste it on our website</li>
                                <li>Get your SteamCMD commands instantly</li>
                                <li>Save as .txt file or copy to clipboard</li>
                            </ul>
                        </div>

                        <div class="tool-card">
                            <h4>BatchFile Generator Browser TamperMonkey Script</h4>
                            <p>Adds convenience right on Steam pages:</p>
                            <ul>
                                <li>Works directly on Workshop pages</li>
                                <li>Adds a generate button to collections</li>
                                <li>Uses our website in the background</li>
                                <li>Same output options as the website</li>
                            </ul>
                        </div>
                    </div>

                    <div class="notice-box">
                        <h4>💡 Want to automate the download process?</h4>
                        <p>Both BatchFile generator tools create the same command file format. Once you have your commands, you can:
                            <ul>
                                <li>Use them directly with SteamCMD</li>
                                <li>Or use our <a href="#workshop-mod-manager">Workshop Mod Manager</a> for automated downloads and installation</li>
                            </ul>
                        </p>
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
                        <li>Use the BatchFile Generator (website or TamperMokey Script)</li>
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

                <!-- Mod Manager Integration -->
                <div id="mod-manager-intro" class="card sub-card">
                    <h3>Simplifying installation with Workshop Mod Manager</h3>
                    <p>Our Workshop Mod Manager (Windows) can help automate the download and installation process:</p>

                    <div class="notice-box info">
                        <h4>How it works:</h4>
                        <ul>
                            <li>Uses the commands from our BatchFile Generator</li>
                            <li>Handles SteamCMD downloads automatically</li>
                            <li>Helps organize mods in the correct game folders</li>
                            <li>Makes mod management much easier</li>
                        </ul>
                    </div>

                    <div class="example-box">
                        <h4>Example:</h4>
                        <p>SteamCMD default structure:</p>
                        <code>steamapps/workshop/content/108600/2699828474/mods/Rebalanced Prop Moving/...</code>
                        <br>    
                        <p>Workshop Mod Manager organizes it as:</p>
                        <code>YourGame/Mods/Rebalanced Prop Moving/...</code>
                    </div>

                    <div class="notice-box">
                        <h4>💡 Advantage</h4>
                        <p>No need to manually organize files - the Mod Manager handles the file structure automatically!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <!-- 3. Using Generated Scripts -->
    <div id="steamcmd-setup" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">3. Using Generated Scripts with SteamCMD</h2>
            
            <div itemprop="text">
                <!-- Script Overview -->
                <div class="card sub-card">
                    <h3>Understanding Your Generated Script</h3>
                    <p>Our BatchFile Generator creates a ready-to-use script containing all necessary commands. Let's look at what's included:</p>
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

                <!-- Script Features -->
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
        <!-- 4. Workshop Mod Manager -->
    <div id="mod-manager-details" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">4. Workshop Mod Manager Details</h2>
            
            <div itemprop="text">
                <!-- App Overview -->
                <div class="card sub-card">
                    <h3>About the Workshop Mod Manager</h3>
                    <p>The Workshop Mod Manager is our Windows application that automates mod downloads and installation. 
                    It works with the command files from our BatchFile Generator to make the whole process easier.</p>

                    <!-- Screenshot -->
                    <div class="app-preview">
                        <img src="/includes/images/Workshop_Mod_Manager.png" alt="Mod Manager Interface" class="app-screenshot">
                        <p class="caption">The Mod Manager's main window</p>
                    </div>

                    <div class="notice-box info">
                        <h4>💡 Community Project</h4>
                        <p>The Workshop Mod Manager will be released as open-source software, allowing everyone 
                        to help improve it and adapt it to their needs.</p>
                    </div>
                </div>

                <!-- Features -->
                <div class="card sub-card">
                    <h3>What it does</h3>
                    <ul class="feature-list">
                        <li><span role="img" aria-label="game controller">🎮</span> Automates mod downloads using SteamCMD</li>
                        <li><span role="img" aria-label="chart">📊</span> Shows download progress clearly</li>
                        <li><span role="img" aria-label="memo">📝</span> Organizes mods in the correct folders</li>
                        <li><span role="img" aria-label="broom">🧹</span> Optional cleanup of temporary files</li>
                        <li><span role="img" aria-label="gear">⚙️</span> Easy SteamCMD configuration</li>
                        <li><span role="img" aria-label="stop button">⏹️</span> Full control over the download process</li>
                    </ul>
                </div>

                <!-- Requirements -->
                <div class="card sub-card">
                    <h3>What you need to run it</h3>
                    <ul>
                        <li>A 64-bit Windows PC</li>
                        <li>.NET 8.0 Runtime (<a href=https://dotnet.microsoft.com/en-us/download/dotnet/8.0>download it here</a>)</li>
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
                    <p>The Workshop Mod Manager will be free to use under the Creative Commons Attribution-NonCommercial License:</p>
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
