<?php 
define('PAGE_SCRIPTS', ['/js/slide.js', '/js/feedback.js']); 
include '../includes/header.php';
?>

<div class="guide-section" itemscope itemtype="https://schema.org/HowTo">
    <div class="guide-header">
        <h1 itemprop="name">Complete Workshop Collection Guide</h1>
        <h2 itemprop="description">How to use Steam Workshop mods with any game - Steam and non-Steam versions</h2>
    </div>

<?php
    $cardFiles = glob('../includes/guide-cards/[0-9]*.php');
    sort($cardFiles);
    $cardCount = count($cardFiles);
?>

    <!-- Kein inline Script mehr, stattdessen data-Attribut -->
    <div class="cards-container" data-card-count="<?php echo $cardCount; ?>">
        <div class="cards-slider">
        <?php    
            foreach($cardFiles as $card) {
                include $card;
            }
        ?>    
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>