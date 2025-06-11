// Ouverture du modal via délégation
document.addEventListener('click', function(event) {
    const openBtn = event.target.closest('.modal-open');
    if (openBtn) {
        const modalId = openBtn.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if(modal){
            modal.style.display = "flex";
        }
    }
});

// Fermeture du modal via délégation
document.addEventListener('click', function(event) {
    const closeBtn = event.target.closest('.modal-close');
    if (closeBtn) {
        const modalId = closeBtn.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if(modal){
            modal.style.display = "none";
        }
    }
});
