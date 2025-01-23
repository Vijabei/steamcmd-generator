<?php 
$jsPath = $isSubDirectory ? '../js' : './js';
?>
    </main>
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> SoftKnight - softknight.de</p>
            <p class="version">Version 2.00 Beta 2</p>
            <p class="changelog">Last feature: Tamper Monkey Script for direct download with your browser on Steam</p>
            <p class="status">Known issues: FAQ and help pages must be rewritten and merged. Please report any issues.</p>
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
