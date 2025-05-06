import './bootstrap';

import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('reload-btn');
    if (btn) {
        btn.addEventListener('click', () => {
            alert('Le hot reload fonctionne !');
        });
    }
});
