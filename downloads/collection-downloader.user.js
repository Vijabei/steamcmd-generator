// ==UserScript==
// @name         Steam Workshop Downloader (Collection & Personal) Enhanced
// @namespace    https://softknight.de/
// @version      1.5.0
// @description  Generate SteamCMD download commands for Steam Workshop collections and personal subscriptions with multi-page support
// @author       SoftKnight
// @match        https://steamcommunity.com/sharedfiles/filedetails/?id=*
// @match        https://steamcommunity.com/workshop/filedetails/?id=*
// @match        https://steamcommunity.com/id/*/myworkshopfiles*
// @match        https://steamcommunity.com/profiles/*/myworkshopfiles*
// @grant        GM_xmlhttpRequest
// @grant        GM_setValue
// @grant        GM_getValue
// @connect      softknight.de
// @downloadURL  https://softknight.de/downloads/collection-downloader.user.js
// @updateURL    https://softknight.de/downloads/collection-downloader.user.js
// ==/UserScript==

(function() {
    'use strict';

    // State management for mod collection
    const ModCollector = {
        modIds: new Set(),
        currentPage: 1,
        totalPages: 1,
        isCollecting: false,
        appId: null,

        reset() {
            this.modIds.clear();
            this.currentPage = 1;
            this.isCollecting = false;
        },

        async initialize() {
            // Extract total pages from pagination.
            // Locale-independent: the largest number in the paging info is
            // the total item count, regardless of the Steam UI language
            // ("Showing 1-30 of 129 entries" / "1-30 von 129 Ergebnissen").
            const paginationText = document.querySelector('.workshopBrowsePagingInfo')?.textContent;
            if (paginationText) {
                const numbers = (paginationText.replace(/[., ]/g, '').match(/\d+/g) || []).map(Number);
                if (numbers.length > 0) {
                    this.totalPages = Math.max(1, Math.ceil(Math.max(...numbers) / 30));
                }
            }

            // Extract appId from URL params
            const urlParams = new URLSearchParams(window.location.search);
            this.appId = urlParams.get('appid');
        }
    };

    // UI Components
    const UI = {
        styles: `
            .sk-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                z-index: 9999;
            }
            .sk-modal-content {
                position: relative;
                background-color: #F8F9FA;
                margin: 15% auto;
                padding: 20px;
                border-radius: 5px;
                width: 80%;
                max-width: 600px;
            }
            .sk-close {
                position: absolute;
                right: 10px;
                top: 5px;
                font-size: 24px;
                cursor: pointer;
            }
            .sk-commands {
                width: 100%;
                height: 200px;
                margin: 10px 0;
                font-family: monospace;
                padding: 10px;
            }
            .sk-message {
                margin: 10px 0;
                padding: 10px;
                border-radius: 4px;
            }
            .sk-info-message {
                background-color: #e0f2fe;
                color: #0369a1;
                padding: 10px;
                margin: 10px 0;
                border-radius: 4px;
                font-size: 14px;
            }
            .sk-error {
                background-color: #fee2e2;
                color: #dc2626;
            }
            .sk-success {
                background-color: #dcfce7;
                color: #10b981;
            }
            .button-group {
                display: flex;
                gap: 10px;
                margin-top: 15px;
            }
            .sk-collect-button {
                background-color: #4CAF50;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                margin: 10px 0;
                transition: background-color 0.3s;
            }
            .sk-collect-button:hover {
                background-color: #45a049;
            }
            .sk-progress {
                margin: 10px 0;
                padding: 10px;
                background-color: #f8f9fa;
                border-radius: 4px;
                display: none;
            }
            .sk-progress-bar {
                width: 100%;
                height: 20px;
                background-color: #eee;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 5px;
            }
            .sk-progress-fill {
                height: 100%;
                background-color: #4CAF50;
                width: 0%;
                transition: width 0.3s ease;
            }
            .sk-download-button {
                background-color: #4CAF50;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: background-color 0.3s;
            }
            .sk-download-button:hover {
                background-color: #45a049;
            }
        `,

        createCollectButton() {
            const button = document.createElement('button');
            button.className = 'sk-collect-button';
            button.textContent = 'Collect All Pages & Generate Commands';
            button.onclick = this.handleCollectClick;
            return button;
        },

        createProgressBar() {
            const container = document.createElement('div');
            container.className = 'sk-progress';
            container.innerHTML = `
                <div>Collecting mods from all pages...</div>
                <div class="sk-progress-bar">
                    <div class="sk-progress-fill"></div>
                </div>
            `;
            return container;
        },

        async handleCollectClick() {
            if (ModCollector.isCollecting) return;

            ModCollector.isCollecting = true;
            UI.showProgress();

            await ModCollector.initialize();
            await PageProcessor.processAllPages();

            ModCollector.isCollecting = false;
            UI.hideProgress();

            if (ModCollector.modIds.size > 0) {
                await CommandGenerator.generateAndShowCommands([...ModCollector.modIds]);
            }
        },

        updateProgress(current, total) {
            const progress = document.querySelector('.sk-progress');
            const progressFill = document.querySelector('.sk-progress-fill');
            if (progress && progressFill) {
                progress.style.display = 'block';
                const percentage = (current / total) * 100;
                progressFill.style.width = `${percentage}%`;
            }
        },

        showProgress() {
            const progress = document.querySelector('.sk-progress');
            if (progress) progress.style.display = 'block';
        },

        hideProgress() {
            const progress = document.querySelector('.sk-progress');
            if (progress) progress.style.display = 'none';
        },

        initialize() {
            // Add styles
            const styleSheet = document.createElement('style');
            styleSheet.textContent = this.styles;
            document.head.appendChild(styleSheet);

            // Add UI elements based on page type
            if (/\/(sharedfiles|workshop)\/filedetails\//.test(window.location.href)) {
                // Collection Page
                const targetElement = document.querySelector('.workshopItemDescriptionTitle');
                if (targetElement) {
                    const button = document.createElement('button');
                    button.className = 'sk-collect-button';
                    button.textContent = 'Generate Download Commands';
                    button.onclick = () => CommandGenerator.handleCollectionRequest(window.location.href);
                    targetElement.parentNode.insertBefore(button, targetElement);
                }
            } else {
                // Personal Page - Add multi-page collection elements
                const container = document.querySelector('.rightDetailsBlock');
                if (container) {
                    const progressContainer = document.createElement('div');
                    progressContainer.appendChild(this.createProgressBar());

                    container.insertBefore(this.createCollectButton(), container.firstChild);
                    container.insertBefore(progressContainer, container.firstChild);
                }
            }
        }
    };

    // Page Processing
const PageProcessor = {
    async processAllPages() {
        for (let page = 1; page <= ModCollector.totalPages; page++) {
            if (!ModCollector.isCollecting) break;

            ModCollector.currentPage = page;
            UI.updateProgress(page, ModCollector.totalPages);

            await this.fetchAndProcessPage(page);
            await new Promise(resolve => setTimeout(resolve, 500));
        }
    },

    async fetchAndProcessPage(page) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.delete('p');
        currentUrl.searchParams.append('p', page.toString());

        try {
            const response = await fetch(currentUrl.toString());
            const text = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(text, 'text/html');

            const subscriptions = doc.querySelectorAll('.workshopItemSubscription');

            subscriptions.forEach(sub => {
                const idMatch = sub.id.match(/Subscription(\d+)/);
                if (idMatch) {
                    ModCollector.modIds.add(idMatch[1]);
                }
            });
        } catch (error) {
            console.error(`Error fetching page ${page}:`, error);
        }
    }
};

    // Command Generation
    const CommandGenerator = {
        async handleCollectionRequest(collectionUrl) {
            try {
                const response = await new Promise((resolve, reject) => {
                    GM_xmlhttpRequest({
                        method: 'POST',
                        url: 'https://softknight.de/generate.php',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        data: `collectionURL=${encodeURIComponent(collectionUrl)}`,
                        onload: resolve,
                        onerror: reject
                    });
                });

                const result = JSON.parse(response.responseText);
                if (result.success) {
                    this.showCommandsModal(result.downloadCommands);
                } else {
                    throw new Error(result.error || 'Failed to generate commands');
                }
            } catch (error) {
                this.showMessage(error.message, 'error');
            }
        },

        async generateAndShowCommands(modIds) {
            if (!ModCollector.appId) {
                this.showMessage('No game ID found. Please make sure you are viewing items for a specific game.', 'error');
                return;
            }

            try {
                const response = await new Promise((resolve, reject) => {
                    GM_xmlhttpRequest({
                        method: 'POST',
                        url: 'https://softknight.de/generate.php',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        data: `modIds=${encodeURIComponent(JSON.stringify(modIds))}&appId=${encodeURIComponent(ModCollector.appId)}`,
                        onload: resolve,
                        onerror: reject
                    });
                });

                const result = JSON.parse(response.responseText);
                if (result.success) {
                    this.showCommandsModal(result.downloadCommands);
                } else {
                    throw new Error(result.error || 'Failed to generate commands');
                }
            } catch (error) {
                this.showMessage(error.message, 'error');
            }
        },

        showCommandsModal(commands) {
            const modal = document.createElement('div');
            modal.className = 'sk-modal';
            const modCount = commands.split('\n').filter(line => line.startsWith('workshop_download_item')).length;
            modal.innerHTML = `
                <div class="sk-modal-content">
                    <span class="sk-close">&times;</span>
                    <h2>SteamCMD Download Commands</h2>
                    <div id="sk-message"></div>
                    <div class="sk-info-message">
                        Successfully processed ${modCount} mods ${ModCollector.isCollecting ? 'from all pages' : 'from collection'}
                    </div>
                    <textarea class="sk-commands" readonly>${commands}</textarea>
                    <div class="button-group">
                        <button id="downloadBtn" class="sk-download-button">Download Commands</button>
                        <button id="copyBtn" class="sk-download-button">Copy to Clipboard</button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            modal.style.display = 'block';

            // Event Listeners
            const closeBtn = modal.querySelector('.sk-close');
            closeBtn.onclick = () => {
                modal.style.display = 'none';
                modal.remove();
            };

            const downloadBtn = modal.querySelector('#downloadBtn');
            downloadBtn.onclick = () => this.downloadCommands(commands);

            const copyBtn = modal.querySelector('#copyBtn');
            copyBtn.onclick = () => this.copyToClipboard(commands);

            window.onclick = (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    modal.remove();
                }
            };
        },

        async downloadCommands(commands) {
            try {
                const blob = new Blob([commands], { type: 'text/plain;charset=utf-8' });
                const url = window.URL.createObjectURL(blob);
                const downloadLink = document.createElement('a');

                downloadLink.href = url;
                downloadLink.download = 'steamcmd_commands.txt';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
                window.URL.revokeObjectURL(url);

                await this.trackButtonClick('download');
                this.showMessage('Commands downloaded successfully!', 'success');
            } catch (error) {
                console.error('Download error:', error);
                this.showMessage('Download failed. Please try again.', 'error');
            }
        },

        async copyToClipboard(commands) {
            try {
                await navigator.clipboard.writeText(commands);
                this.showMessage('Commands copied to clipboard!', 'success');
                await this.trackButtonClick('clipboard');
            } catch (error) {
                console.error('Copy error:', error);
                this.showMessage('Failed to copy commands. Please try again.', 'error');
            }
        },

        async trackButtonClick(type) {
            try {
                await GM_xmlhttpRequest({
                    method: 'GET',
                    url: `https://softknight.de/generate.php?countButtonClick=true&type=${type}&source=tampermonkey`,
                });
            } catch (error) {
                console.error('Failed to track button click:', error);
            }
        },

        showMessage(message, type = 'info') {
            const messageDiv = document.querySelector('#sk-message');
            if (messageDiv) {
                messageDiv.className = `sk-message sk-${type}`;
                messageDiv.textContent = message;
                // Optional: Message nach 3 Sekunden ausblenden
                setTimeout(() => {
                    messageDiv.textContent = '';
                    messageDiv.className = 'sk-message';
                }, 3000);
            }
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => UI.initialize());
    } else {
        UI.initialize();
    }
})();