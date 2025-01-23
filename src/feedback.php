<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class FeedbackHandler {
    private $feedback_dir;
    private $allowed_fields;
    
    public function __construct() {
        $this->feedback_dir = __DIR__ . '/feedback/';
        $this->allowed_fields = ['feedback', 'name', 'email'];
        
        if (!is_dir($this->feedback_dir)) {
            mkdir($this->feedback_dir, 0755, true);
        }
    }
    
    public function handleFeedback($post_data, $csrf_token) {
        try {
            if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
                throw new Exception('Invalid security token');
            }
            
            if (empty($post_data['feedback'])) {
                throw new Exception('Feedback is required');
            }
            
            $cleaned_data = $this->sanitizeInput($post_data);
            $this->saveFeedback($cleaned_data);
            
            return ['success' => true, 'message' => 'Thank you for your feedback.'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    private function sanitizeInput($data) {
        $cleaned = [];
        foreach ($this->allowed_fields as $field) {
            if (isset($data[$field])) {
                $cleaned[$field] = htmlspecialchars(trim($data[$field]), ENT_QUOTES, 'UTF-8');
            }
        }
        return $cleaned;
    }
    
    private function saveFeedback($data) {
        $filename = $this->feedback_dir . 'feedback_' . uniqid() . '_' . time() . '.txt';
        $content = "Timestamp: " . date('Y-m-d H:i:s') . "\n";
        
        foreach ($data as $key => $value) {
            $content .= ucfirst($key) . ": " . $value . "\n";
        }
        
        if (file_put_contents($filename, $content) === false) {
            throw new Exception('Could not save feedback');
        }
    }
}

// Process AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    
    $handler = new FeedbackHandler();
    $result = $handler->handleFeedback(
        $_POST,
        $_POST['csrf_token'] ?? ''
    );
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>

<!-- Feedback Form Template -->
<div id="feedbackPopup" class="feedback-popup">
    <div class="feedback-popup-content">
        <span class="close-button">&times;</span>
        <h2>Feedback</h2>
        <div id="feedbackMessage"></div>
        <form id="feedbackForm">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            
            <div class="form-group">
                <label for="feedback">Your message (required):</label>
                <textarea id="feedback" name="feedback" rows="5" required 
                    class="form-control" minlength="10" maxlength="1000"></textarea>
            </div>

            <div class="form-group">
                <label for="name">Name (optional):</label>
                <input type="text" id="name" name="name" class="form-control" 
                    maxlength="50" pattern="[A-Za-z0-9\s-]{0,50}">
            </div>

            <div class="form-group">
                <label for="email">E-Mail (optional):</label>
                <input type="email" id="email" name="email" class="form-control" 
                    maxlength="100">
            </div>

            <button type="submit" class="btn">Send Feedback</button>
        </form>
    </div>
</div>
