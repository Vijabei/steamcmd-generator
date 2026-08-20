<?php
define('PAGE_TITLE', 'FAQ');
define('PAGE_DESCRIPTION', 'Answers to common questions: Do you need Steam installed? Where are downloaded mods stored? Why do some workshop downloads fail? Is it free?');
define('PAGE_SCRIPTS', ['/js/slide.js']);
include '../includes/header.php';

function getFAQContent($file) {
    $content = file_get_contents($file);
    $lines = explode("\n", $content);
    $question = trim(array_shift($lines)); // Erste Zeile ist die Frage
    $answer = trim(implode("\n", $lines)); // Rest ist die Antwort
    
    return [
        'question' => $question,
        'answer' => $answer
    ];
}

?>

<div class="faq-section" itemscope itemtype="https://schema.org/FAQPage">
    <h1 itemprop="name">Frequently Asked Questions</h1>
    <h2 itemprop="description">Find Answers to Common Questions About Workshop Collection Downloader</h2>

    <?php
    $faqFiles = glob('../includes/faq/[0-9]*.txt');
    sort($faqFiles);
    
    foreach ($faqFiles as $file):
        $faq = getFAQContent($file);
    ?>
        <div class="card">
            <div itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
                <h3 itemprop="name"><?php echo htmlspecialchars($faq['question']); ?></h3>
                <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text">
                        <?php echo $faq['answer']; // HTML wird direkt ausgegeben ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Where to ask -->
    <div class="support-section card">
        <h3>Need More Help?</h3>
        <p>If your question is not answered here, open an issue on GitHub. You will be
           notified when it is answered, and you can see what is already being worked on.</p>
        <div class="button-group">
            <a href="<?php echo htmlspecialchars($release['links']['issues_app']); ?>" target="_blank" rel="noopener" class="btn">Workshop Manager issues</a>
            <a href="<?php echo htmlspecialchars($release['links']['issues_site']); ?>" target="_blank" rel="noopener" class="btn btn-secondary">Website &amp; script issues</a>
        </div>
        <p class="mb-6">A GitHub account is free. Please say which tool you used and what
           you expected to happen - that is usually enough to reproduce a problem.</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
