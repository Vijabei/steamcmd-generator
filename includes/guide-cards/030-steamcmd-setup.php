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
                        workshop_download_item ...    // Your mod downloads<br>
                        quit                          // Exits SteamCMD when done
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
                        <p>SteamCMD will show download progress for each mod in your collection.
                        If single mods fail (timeouts, login-restricted content), see the
                        <a href="faq.php">FAQ</a> - often simply running the script again helps,
                        SteamCMD continues where it stopped.</p>
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