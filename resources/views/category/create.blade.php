<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Ajouter une catégorie</p>
        <button class="modal-close" data-modal="createCategory">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="createCategoryForm">
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded dark:bg-gray-800 dark:text-white" type="text" name="name" id="name" autocomplete="off">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button data-project-id="{{ $project->id }}" class="btn-store-category bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">Ajouter</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="createCategory">Fermer</button>
    </div>
</div>