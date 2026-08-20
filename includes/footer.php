<?php
// $jsPath is provided by includes/config.php
?>
    </main>
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> SoftKnight - softknight.de</p>
            <p class="version">Version <?php echo htmlspecialchars($release['site_version']); ?></p>
            <p class="changelog"><?php echo $release['changelog']; ?></p>
            <p class="status">Found a bug or missing a guide? Report it on GitHub:
                <a href="<?php echo htmlspecialchars($release['links']['issues_app']); ?>" target="_blank" rel="noopener">app issues</a> &middot;
                <a href="<?php echo htmlspecialchars($release['links']['issues_site']); ?>" target="_blank" rel="noopener">website &amp; script issues</a></p>
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
