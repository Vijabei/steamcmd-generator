<?php
define('PAGE_TITLE', 'FAQ');
define('PAGE_DESCRIPTION', 'Answers to common questions: Do you need Steam installed? Where are downloaded mods stored? Why do some workshop downloads fail? Is it free?');
define('PAGE_SCRIPTS', ['/js/slide.js', '/js/feedback.js']);
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

    <!-- Feedback section -->
    <div class="feedback-section card">
        <h3>Need More Help?</h3>
        <p>If you can't find the answer to your question, feel free to send us feedback.</p>
        <button id="openFeedbackPopup" class="btn">Send Feedback</button>
        <?php include '../feedback.php'; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
