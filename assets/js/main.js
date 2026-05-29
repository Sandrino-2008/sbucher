// assets/js/main.js
document.addEventListener('DOMContentLoaded', () => {
    
    // Tab Switching im Dashboard (für Admins)
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');

    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-target');

                // Tabs toggeln
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Content Blöcke toggeln
                contents.forEach(content => {
                    if (content.id === target) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
            });
        });
    }
});
