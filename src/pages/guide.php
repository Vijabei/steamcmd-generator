<?php include '../includes/header.php'; ?>

<div class="guide-section" itemscope itemtype="https://schema.org/HowTo">
    <div class="guide-header">
        <h1 itemprop="name">Complete Workshop Collection Guide</h1>
        <h2 itemprop="description">How to use Steam Workshop mods with any game - Steam and non-Steam versions</h2>
    </div>

<?php
    $cardFiles = glob('../includes/guide-cards/[0-9]*.php');
    $cardCount = count($cardFiles);
?>

<style>
    :root {
        --card-count: <?php echo $cardCount; ?>;
    }
</style>

    <!-- Sliding Function -->
    <div class="cards-container">
    <div class="cards-slider">

    <?php    
    // Alle Card-Dateien einlesen und sortieren
        $cardFiles = glob('../includes/guide-cards/[0-9]*.php');
        sort($cardFiles);
        
        // Cards nacheinander einbinden
        foreach($cardFiles as $card) {
            include $card;
        }
    ?>    


    <!-- End Sliding Function -->
    </div>
    </div>


</div>

<?php include '../includes/footer.php'; ?>
