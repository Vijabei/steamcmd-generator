<?php
$basePath = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false ? '..' : '.';
?>
<nav class="nav-main">
    <div class="container">
        <ul>
            <li><a href="<?php echo $basePath; ?>/">Home</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/generate-commands.php">Generate Commands</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/download-tools.php">Download Tools</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/guide.php">Guide</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/faq.php">FAQ</a></li>
            <li class="nav-theme">
                <select class="theme-select" aria-label="Choose theme">
                    <option value="light">☀️ Light</option>
                    <option value="dark">🌙 Dark</option>
                    <option value="steam">🎮 Steam</option>
                </select>
            </li>
        </ul>
    </div>
</nav>