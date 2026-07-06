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
                        <li>Paste it into the Workshop Mod Manager or the BatchFile Generator (website or TamperMonkey script)</li>
                        <li>Follow the SteamCMD instructions to download your mods</li>
                    </ol>

                    <div class="notice-box info">
                        <h4>URL Format</h4>
                        <p>Collection URLs typically look like this:<br>
                        <code>https://steamcommunity.com/sharedfiles/filedetails/?id=1234567890</code></p>
                    </div>
                </div>

                <!-- Subscriptions section -->
                <div class="card sub-card">
                    <h3>No collection? Use your subscriptions</h3>
                    <p>If you don't own the game on Steam, you can't create a collection for it - but you can still
                    <strong>subscribe</strong> to the mods you want and download from your personal subscription list:</p>

                    <ul>
                        <li>In the <strong>Workshop Mod Manager</strong>: open your subscriptions page in the built-in browser and click "Collect items from all pages"</li>
                        <li>In your browser: install our <a href="download-tools.php">TamperMonkey script</a>, which adds the same button directly on the Steam page</li>
                    </ul>

                    <div class="notice-box info">
                        <h4>Your subscriptions URL</h4>
                        <p>Replace YOUR-STEAM-USER-NAME with your account name:<br>
                        <code>https://steamcommunity.com/id/YOUR-STEAM-USER-NAME/myworkshopfiles?browsefilter=mysubscriptions</code></p>
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