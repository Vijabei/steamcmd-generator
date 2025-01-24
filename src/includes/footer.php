<?php 
$jsPath = $isSubDirectory ? '../js' : './js';
?>
    </main>
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> SoftKnight - softknight.de</p>
            <p class="version">Version 2.00 Beta 5</p>
            <p class="changelog">Last feature: More clear design in Code Generator and Download section, Guide reworked, made warning collapsable</p>
            <p class="status">Known issues: FAQ page must be rewritten. Please report any issues.</p>
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
