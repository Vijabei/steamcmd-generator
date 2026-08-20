<?php
// $jsPath is provided by includes/config.php
?>
    </main>
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> SoftKnight - softknight.de</p>
            <p class="version">Version 2.4</p>
            <p class="changelog">Latest: relicensed to Apache 2.0, Workshop Manager 1.1 with automatic updates, and version 1.2 in beta testing.</p>
            <p class="status">Found a bug or missing a guide? Use the feedback form on the FAQ page - please include contact info for a reply.</p>
        </div>
    </footer>
    <script src="<?php echo $jsPath; ?>/main.js"></script>
<?php if (defined('PAGE_SCRIPTS')): ?>
    <?php foreach (PAGE_SCRIPTS as $script): ?>
        <script src="<?php echo $isSubDirectory ? '..' : '.'; ?><?php echo $script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
