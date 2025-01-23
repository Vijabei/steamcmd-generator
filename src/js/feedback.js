// Feedback Form Functionality
document.addEventListener('DOMContentLoaded', function() {
    const feedbackForm = document.getElementById('feedbackForm');
    const feedbackPopup = document.getElementById('feedbackPopup');
    const feedbackMessage = document.getElementById('feedbackMessage');
    const closeButton = document.querySelector('.close-button');
    const openFeedbackButton = document.getElementById('openFeedbackPopup');

    // Move popup to body
    if (feedbackPopup && feedbackPopup.parentElement !== document.body) {
        document.body.appendChild(feedbackPopup);
    }
    
    // Form Reset Function
    function resetForm() {
        if (feedbackForm) {
            feedbackForm.reset();
            feedbackMessage.innerHTML = '';
        }
    }
    
    // Popup Manager
    class PopupManager {
        static show() {
            if (feedbackPopup) {
                feedbackPopup.style.display = 'flex';
                feedbackPopup.offsetHeight; // Force reflow
                feedbackPopup.classList.add('active');
                resetForm();
                document.body.style.overflow = 'hidden';
            }
        }
        
        static hide() {
            if (feedbackPopup) {
                feedbackPopup.classList.remove('active');
                setTimeout(() => {
                    feedbackPopup.style.display = 'none';
                    document.body.style.overflow = '';
                }, 300);
            }
        }
        
        static showMessage(message, type = 'error') {
            if (feedbackMessage) {
                feedbackMessage.innerHTML = `<div class="message message-${type}">${message}</div>`;
            }
        }
    }
    
    // Event Listeners
    if (openFeedbackButton) {
        openFeedbackButton.addEventListener('click', (e) => {
            e.preventDefault();
            PopupManager.show();
        });
    }
    
    if (closeButton) {
        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            PopupManager.hide();
        });
    }
    
    // Close popup when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === feedbackPopup) {
            PopupManager.hide();
        }
    });
    
    // Form Submit Handler
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            
            try {
                const formData = new FormData(this);
                
                // Validate feedback length
                const feedback = formData.get('feedback');
                if (feedback.length < 10) {
                    PopupManager.showMessage('Feedback must be at least 10 characters long.');
                    return;
                }
                
                // Get CSRF token
                const csrfToken = formData.get('csrf_token');
                if (!csrfToken) {
                    throw new Error('Security token missing');
                }
                
                // Determine correct path
                const feedbackPath = window.location.pathname.includes('/pages/') ? '../feedback.php' : './feedback.php';
                
                const response = await fetch(feedbackPath, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });
                
                const result = await response.json();
                
                if (result.success) {
                    PopupManager.showMessage(result.message, 'success');
                    setTimeout(() => {
                        PopupManager.hide();
                        resetForm();
                    }, 2000);
                } else {
                    PopupManager.showMessage(result.message);
                }
            } catch (error) {
                PopupManager.showMessage('An unexpected error occurred. Please try again later.');
            }
        });
    }
});
