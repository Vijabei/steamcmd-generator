<?php
// Am Anfang der navigation.php
$basePath = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false ? '..' : '.';
?>
<nav class="nav-main">
    <div class="container">
        <ul>
            <li><a href="<?php echo $basePath; ?>/">Home</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/collection-download.php">Download</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/workshop-guide.php">Guide</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/server-setup.php">Setup</a></li>
            <li><a href="<?php echo $basePath; ?>/pages/faq.php">FAQ</a></li>
        </ul>
    </div>
</nav>
