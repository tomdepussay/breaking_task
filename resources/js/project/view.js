let views = [];

document.querySelectorAll('.views').forEach((el) => {
    views.push(el);
});

document.querySelectorAll('.change-view').forEach((button) => {
    button.addEventListener('click', () => {
        const view = button.getAttribute('data-view');

        views.forEach((el) => {
            el.classList.toggle('hidden', el.getAttribute('data-view') !== view);
        });

        document.querySelectorAll('.change-view').forEach((el) => {
            const isActive = el.getAttribute('data-view') === view;
            el.classList.toggle('bg-primaire/10', isActive);
            el.classList.toggle('text-primaire', isActive);
            el.classList.toggle('hover:bg-primaire/20', isActive);

            el.classList.toggle('bg-gray-100/50', !isActive);
            el.classList.toggle('text-gray-700', !isActive);
            el.classList.toggle('hover:bg-gray-200', !isActive);
        });
    });
});
