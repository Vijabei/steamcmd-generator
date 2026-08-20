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
                        contribute on <a href="<?php echo htmlspecialchars($release['links']['repo']); ?>" target="_blank" rel="noopener">GitHub</a>.</p>
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
                        <li><span role="img" aria-label="framed picture">🖼️</span> Shows each mod's preview image, tags and full description, properly formatted</li>
                        <li><span role="img" aria-label="link">🔗</span> Detects required mods and required DLC, with links straight into the built-in browser</li>
                        <li><span role="img" aria-label="books">📚</span> Keeps a local library of every mod you installed, so details survive a mod being removed from the Workshop</li>
                        <li><span role="img" aria-label="outbox tray">📤</span> Exports that library as Markdown files for your notes or a server wiki</li>
                        <li><span role="img" aria-label="artist palette">🎨</span> Dark and light theme</li>
                        <li><span role="img" aria-label="counterclockwise arrows">🔄</span> Keeps itself up to date - new versions install with one click, on a stable or beta channel</li>
                    </ul>
                </div>

                <!-- Walkthrough -->
                <div class="card sub-card">
                    <h3>Quick walkthrough</h3>
                    <ol>
                        <li><strong>Install:</strong> download the zip from the
                            <a href="<?php echo htmlspecialchars($release['links']['latest']); ?>" target="_blank" rel="noopener">GitHub releases page</a>,
                            extract it and run <code>WorkshopManager.exe</code>.</li>
                        <li><strong>Set up (once):</strong> open <em>Settings...</em> in the bottom bar and click
                            <em>Download it for me</em> to fetch SteamCMD (or point to an existing <code>steamcmd.exe</code>).
                            Then choose the install folder of your game.</li>
                        <li><strong>Pick your mods:</strong> browse the Workshop on the "Workshop Browser" tab and click
                            <em>Add this collection / mod to list</em> - or simply paste a collection URL into the "Add mods" field.
                            Your Steam subscriptions can be collected the same way after logging in inside the browser tab.</li>
                        <li><strong>Install:</strong> review the mod list (titles, sizes, status) and click <em>Install Mods</em>.
                            The app downloads everything in batches, retries failures and marks each mod as installed.</li>
                        <li><strong>Stay up to date:</strong> later, just add the same collection again -
                            already installed mods are skipped and available updates are shown.</li>
                        <li><strong>Optional:</strong> click <em>Check requirements</em> to find out which mods need other
                            mods or paid DLC. Steam only publishes that on each mod's own page, so select a few mods first
                            if you do not want to check the whole list at once.</li>
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
                        <a href="<?php echo htmlspecialchars($release['links']['latest']); ?>" target="_blank" rel="noopener">GitHub releases page</a>
                        or from our <a href="download-tools.php#workshop-manager">download page</a>, extract the zip and run
                        <code>WorkshopManager.exe</code>. SteamCMD is <strong>not</strong> required upfront - the app can download it for you.</p>
                    </div>
                </div>

                <!-- License Info -->
                <div class="card sub-card">
                    <h3>Usage Rights</h3>
                    <p>The Workshop Mod Manager is free software under the
                    <a href="https://www.apache.org/licenses/LICENSE-2.0" target="_blank" rel="noopener">Apache License 2.0</a>:</p>
                    <ul>
                        <li>✅ Free to use, privately and commercially</li>
                        <li>✅ OK to modify for your needs</li>
                        <li>✅ Can be shared and redistributed</li>
                        <li>ℹ️ Keep the copyright and licence notices, and say which files you changed</li>
                        <li>ℹ️ Provided as is, without warranty</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
