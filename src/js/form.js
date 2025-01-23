// form.js

class WorkshopFormHandler {
    constructor() {
        // Initialisiere wichtige DOM-Elemente
        this.form = document.getElementById('collectionForm');
        this.urlInput = document.getElementById('collectionURL');
        this.infoFeedback = document.getElementById('infoFeedback');
        this.errorFeedback = document.getElementById('errorFeedback');
        this.commandsDiv = document.getElementById('extractedModIdsAndCommands');
        this.commandsTextarea = document.getElementById('downloadCommands');
        
        // Bestimme den korrekten Basispfad
        this.baseUrl = document.location.pathname.includes('/pages/') ? '..' : '.';
        
        // Konfigurationsvariablen
        this.debounceTimeout = null;
        this.debounceDelay = 300; // Millisekunden
        
        // Binde Event-Handler
        this.initialize();
    }
    
    initialize() {
        // Prüfe ob alle notwendigen Elemente existieren
        if (!this.form || !this.urlInput || !this.commandsDiv) {
            console.error('Required DOM elements not found');
            return;
        }
        
        // Event-Listener für das Formular
        this.form.addEventListener('submit', (event) => {
            event.preventDefault();
            this.handleSubmit();
        });
        
        // Live-Validierung während der Eingabe
        this.urlInput.addEventListener('input', () => {
            this.debounceValidation();
        });
        
        // Initialisiere Tooltip für URL-Format
        this.initializeTooltip();

        // Binde Button-Handler für Download und Copy
        const downloadButton = this.commandsDiv.querySelector('button:first-of-type');
        const copyButton = this.commandsDiv.querySelector('button:last-of-type');
        
        if (downloadButton) {
            downloadButton.textContent = 'Download SteamCMD commands file';
            downloadButton.addEventListener('click', () => this.downloadCommands());
        }
        if (copyButton) {
            copyButton.textContent = 'Copy to Clipboard';
            copyButton.addEventListener('click', () => this.copyCommands());
        }
    }
    
    debounceValidation() {
        clearTimeout(this.debounceTimeout);
        this.debounceTimeout = setTimeout(() => {
            this.validateUrl(this.urlInput.value);
        }, this.debounceDelay);
    }
    
    validateUrl(url) {
        this.clearFeedback();
        
        if (!url) {
            this.showTooltip('Please enter a Steam Workshop Collection URL');
            return false;
        }
        
        if (!url.startsWith('https://')) {
            url = 'https://' + url;
            this.urlInput.value = url;
        }
        
        const pattern = /^https:\/\/steamcommunity\.com\/sharedfiles\/filedetails\/\?id=\d+$/;
        if (!pattern.test(url)) {
            this.showTooltip('Invalid URL format. Example: https://steamcommunity.com/sharedfiles/filedetails/?id=123456789');
            return false;
        }
        
        this.hideTooltip();
        return true;
    }
    
    async handleSubmit() {
        try {
            if (!this.validateUrl(this.urlInput.value)) {
                return;
            }
            
            this.showLoading();
            
            const response = await this.sendRequest();
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.error) {
                throw new Error(data.error);
            }
            
            this.handleSuccess(data);
            
        } catch (error) {
            this.handleError(error);
        } finally {
            this.hideLoading();
        }
    }
    
    async sendRequest() {
        const formData = new FormData();
        formData.append('collectionURL', this.urlInput.value);
        
        return fetch(`${this.baseUrl}/generate.php`, {
            method: 'POST',
            body: formData
        });
    }
    
    handleSuccess(data) {
        if (data.downloadCommands) {
            this.commandsTextarea.value = data.downloadCommands;
            this.commandsDiv.style.display = 'block';
            
            if (data.warning) {
                this.showInfo(data.warning);
            }
            
            this.commandsDiv.scrollIntoView({ behavior: 'smooth' });
        }
    }
    
    handleError(error) {
        this.showError(`Error: ${error.message || 'An unexpected error occurred'}`);
        this.commandsDiv.style.display = 'none';
    }
    
    showLoading() {
        this.form.classList.add('loading');
        this.urlInput.disabled = true;
        this.showInfo('Processing your request...');
    }
    
    hideLoading() {
        this.form.classList.remove('loading');
        this.urlInput.disabled = false;
    }
    
    showError(message) {
        if (this.errorFeedback) {
            this.errorFeedback.innerHTML = `<div class="error-message">${message}</div>`;
        }
    }
    
    showInfo(message) {
        if (this.infoFeedback) {
            this.infoFeedback.innerHTML = `<div class="info-message">${message}</div>`;
        }
    }
    
    clearFeedback() {
        if (this.infoFeedback) this.infoFeedback.innerHTML = '';
        if (this.errorFeedback) this.errorFeedback.innerHTML = '';
        this.hideTooltip();
    }
    
    showTooltip(message) {
        if (this.tooltip) {
            this.tooltip.textContent = message;
            this.tooltip.style.display = 'block';
        }
    }
    
    hideTooltip() {
        if (this.tooltip) {
            this.tooltip.style.display = 'none';
        }
    }
    
    initializeTooltip() {
        const tooltip = document.createElement('div');
        tooltip.className = 'url-tooltip';
        tooltip.style.display = 'none';
        this.urlInput.parentNode.appendChild(tooltip);
        this.tooltip = tooltip;
    }

    async downloadCommands() {
        if (!this.commandsTextarea || !this.commandsTextarea.value.trim()) {
            this.showMessage('No commands to download', 'error');
            return;
        }
        
        try {
            const blob = new Blob([this.commandsTextarea.value], { 
                type: 'text/plain;charset=utf-8'
            });
            
            const url = window.URL.createObjectURL(blob);
            const downloadLink = document.createElement('a');
            
            downloadLink.href = url;
            downloadLink.download = 'steamcmd_commands.txt';
            
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            window.URL.revokeObjectURL(url);
            
            await this.countButtonClick('download');
            this.showMessage('Commands downloaded successfully!', 'success');
            
        } catch (error) {
            console.error('Download error:', error);
            this.showMessage('Download failed. Please try again.', 'error');
        }
    }

    async copyCommands() {
        if (!this.commandsTextarea || !this.commandsTextarea.value.trim()) {
            this.showMessage('No commands to copy', 'error');
            return;
        }
        
        try {
            await navigator.clipboard.writeText(this.commandsTextarea.value);
            this.showMessage('Commands copied to clipboard!', 'success');
            await this.countButtonClick('clipboard');
        } catch (error) {
            console.error('Copy error:', error);
            this.showMessage('Failed to copy commands. Please try again.', 'error');
        }
    }

async countButtonClick(type = 'download') {
    try {
        const response = await fetch(`${this.baseUrl}/generate.php?countButtonClick=true&type=${type}&source=web`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
    } catch (error) {
        console.error('Error counting click:', error);
    }
}

    showMessage(message, type = 'info') {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message message-${type}`;
        messageDiv.textContent = message;
        
        const container = this.commandsDiv;
        container.insertBefore(messageDiv, container.firstChild);
        
        setTimeout(() => messageDiv.remove(), 3000);
    }
}

// Popup Manager für TamperMonkey
class PopupManager {
    constructor() {
        this.popup = document.getElementById('tampermonkeyPopup');
        this.openButton = document.getElementById('openTampermonkeyPopup');
        this.closeButton = this.popup?.querySelector('.close-button');
        this.initialize();
    }

    initialize() {
        if (!this.popup || !this.openButton || !this.closeButton) {
            console.error('Required popup elements not found');
            return;
        }

        this.openButton.addEventListener('click', () => this.show());
        this.closeButton.addEventListener('click', () => this.hide());
        
        // Schließen beim Klick außerhalb
        window.addEventListener('click', (event) => {
            if (event.target === this.popup) {
                this.hide();
            }
        });
    }

    show() {
        this.popup.style.display = 'flex';
        this.popup.offsetHeight; // Force reflow
        this.popup.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    hide() {
        this.popup.classList.remove('active');
        setTimeout(() => {
            this.popup.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new WorkshopFormHandler();
    new PopupManager();
});
