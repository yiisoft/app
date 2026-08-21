/**
 * Vanilla JS — works together with Yii3 backend.
 * No frameworks. Plain DOM + fetch.
 */
(function () {
    'use strict';

    // Wait for DOM
    document.addEventListener('DOMContentLoaded', function () {
        var box = document.getElementById('yii3-vanilla-box');
        if (!box) {
            return;
        }

        var statusEl = document.getElementById('yii3-status');
        var timeEl = document.getElementById('yii3-time');
        var btn = document.getElementById('yii3-refresh');

        function render(data) {
            if (statusEl) {
                statusEl.textContent = data.status || 'unknown';
                statusEl.className = 'yii3-badge yii3-badge--' + (data.status === 'ok' ? 'ok' : 'warn');
            }
            if (timeEl) {
                timeEl.textContent = data.time || '';
            }
            box.classList.add('yii3-loaded');
        }

        function loadHealth() {
            if (statusEl) {
                statusEl.textContent = 'loading...';
            }
            fetch('/api/health', { headers: { 'Accept': 'application/json' } })
                .then(function (res) {
                    if (!res.ok) {
                        throw new Error('HTTP ' + res.status);
                    }
                    return res.json();
                })
                .then(render)
                .catch(function (err) {
                    if (statusEl) {
                        statusEl.textContent = 'error: ' + err.message;
                        statusEl.className = 'yii3-badge yii3-badge--warn';
                    }
                });
        }

        if (btn) {
            btn.addEventListener('click', loadHealth);
        }

        // Initial load (co-work with Yii3 API)
        loadHealth();
    });
})();
