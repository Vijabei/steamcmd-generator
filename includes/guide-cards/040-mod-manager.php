<div id="mod-manager-details" class="card main-card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h2 itemprop="name">4. Workshop Mod Manager Details</h2>

            <div itemprop="text">
                <!-- App Overview -->
                <div class="card sub-card">
                    <h3>About the Workshop Mod Manager</h3>
                    <p>The Workshop Mod Manager is our free Windows application that handles the complete process:
                    browse the Steam Workshop in its built-in browser, import a collection (or your subscribed items)
                    with one click, and let it download and install everything for you.</p>

                    <!-- Screenshot -->
                    <div class="app-preview">
                        <img src="/includes/images/Workshop_Mod_Manager.png" alt="Workshop Mod Manager showing an imported collection with mod titles, sizes and status" class="app-screenshot">
                        <p class="caption">The Mod Manager with an imported collection, ready to install</p>
                    </div>

                    <div class="notice-box info">
                        <h4>💡 Open Source</h4>
                        <p>The Workshop Mod Manager is open source. You can review the code, report issues and
                        contribute on <a href="https://github.com/Vijabei/SteamWorkshopManager" target="_blank" rel="noopener">GitHub</a>.</p>
                    </div>
                </div>

                <!-- Features -->
                <div class="card sub-card">
                    <h3>What it does</h3>
                    <ul class="feature-list">
                        <li><span role="img" aria-label="globe">🌐</span> Built-in Steam Workshop browser - import collections and subscribed items directly</li>
                        <li><span role="img" aria-label="package">📦</span> Resolves collections locally via the official Steam Web API (nested collections included)</li>
                        <li><span role="img" aria-label="down arrow">⬇️</span> Downloads and configures SteamCMD for you</li>
                        <li><span role="img" aria-label="repeat">🔁</span> Downloads in batches with automatic retries - reliable even for huge collections</li>
                        <li><span role="img" aria-label="magnifying glass">🔍</span> Shows mod titles, sizes and update dates, skips already installed mods and detects updates</li>
                        <li><span role="img" aria-label="memo">📝</span> Organizes mods in the correct folders</li>
                        <li><span role="img" aria-label="broom">🧹</span> Optional cleanup of temporary files</li>
                        <li><span role="img" aria-label="stop button">⏹️</span> Full control: progress display and cancel at any time</li>
                    </ul>
                </div>

                <!-- Walkthrough -->
                <div class="card sub-card">
                    <h3>Quick walkthrough</h3>
                    <ol>
                        <li><strong>Install:</strong> download the zip from the
                            <a href="https://github.com/Vijabei/SteamWorkshopManager/releases/latest" target="_blank" rel="noopener">GitHub releases page</a>,
                            extract it and run <code>WorkshopManager.exe</code>.</li>
                        <li><strong>Set up (once):</strong> on the "Mods &amp; Install" tab, click <em>Get SteamCMD</em>
                            (or point to an existing <code>steamcmd.exe</code>) and choose the install folder of your game.</li>
                        <li><strong>Pick your mods:</strong> browse the Workshop on the "Workshop Browser" tab and click
                            <em>Add this collection / mod to list</em> - or simply paste a collection URL into the "Add mods" field.
                            Your Steam subscriptions can be collected the same way after logging in inside the browser tab.</li>
                        <li><strong>Install:</strong> review the mod list (titles, sizes, status) and click <em>Install Mods</em>.
                            The app downloads everything in batches, retries failures and marks each mod as installed.</li>
                        <li><strong>Stay up to date:</strong> later, just add the same collection again -
                            already installed mods are skipped and available updates are shown.</li>
                    </ol>
                </div>

                <!-- Requirements -->
                <div class="card sub-card">
                    <h3>What you need to run it</h3>
                    <ul>
                        <li>A 64-bit Windows PC (Windows 10/11)</li>
                        <li>.NET 8.0 Desktop Runtime (<a href="https://dotnet.microsoft.com/en-us/download/dotnet/8.0" target="_blank" rel="noopener">download it here</a>)</li>
                        <li>Enough space for your mods</li>
                    </ul>

                    <div class="notice-box">
                        <h4>Getting Started</h4>
                        <p>Grab the latest version from the
                        <a href="https://github.com/Vijabei/SteamWorkshopManager/releases/latest" target="_blank" rel="noopener">GitHub releases page</a>
                        or from our <a href="download-tools.php#workshop-manager">download page</a>, extract the zip and run
                        <code>WorkshopManager.exe</code>. SteamCMD is <strong>not</strong> required upfront - the app can download it for you.</p>
                    </div>
                </div>

                <!-- License Info -->
                <div class="card sub-card">
                    <h3>Usage Rights</h3>
                    <p>The Workshop Mod Manager is free to use under the Creative Commons Attribution-NonCommercial License:</p>
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
