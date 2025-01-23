<?php include '../includes/header.php'; ?>

<div class="setup-guide" itemscope itemtype="https://schema.org/HowTo">
    <h1 itemprop="name">Server Setup Guide for Steam Workshop Content</h1>
    <h2 itemprop="description">Complete Guide to Setup SteamCMD for Workshop Downloads</h2>

    <div class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h3 itemprop="name">Installing SteamCMD</h3>
            <div itemprop="text">
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
            </div>
        </div>
    </div>

    <div class="card">
        <div itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
            <h3 itemprop="name">Using our Generated Commands</h3>
            <div itemprop="text">
                <ol>
                    <li>Generate commands using our collection downloader</li>
                    <li>Save the generated file in your SteamCMD directory</li>
                    <li>Run SteamCMD</li>
                    <li>Execute: +runscript steamcmd_commands.txt</li>
                    <li>Wait for downloads to complete</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>Important Considerations</h3>
        <div class="notice-box">
            <ul>
                <li>Ensure sufficient disk space is available for all workshop content before starting downloads</li>
                <li>Some games require an active Steam login for workshop content access</li>
                <li>Regularly update SteamCMD to maintain compatibility with new workshop items</li>
                <li>Consult game-specific documentation for proper mod installation procedures</li>
            </ul>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
