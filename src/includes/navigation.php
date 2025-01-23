<?php
$basePath = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false ? '..' : '.';
?>
<nav class="nav-main">
    <div class="container">
        <ul>
            <li><a href="<?php echo $basePath; ?>/">Home</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/generate-commands.php">Generate Commands</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/download-tools.php">Download Tools</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/setup-guide.php">Setup Guide</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/faq.php">FAQ</a></li>
        </ul>
    </div>
</nav>