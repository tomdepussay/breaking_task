document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("taskSearchInput");
    const rows = document.querySelectorAll('[data-view="table"] tbody tr');

    if (!searchInput) return;

    searchInput.addEventListener("input", () => {
        const query = searchInput.value.trim().toLowerCase();

        rows.forEach((row) => {
            const text = row.dataset.search ?? "";
            row.style.display = text.includes(query) ? "" : "none";
        });
    });
});
