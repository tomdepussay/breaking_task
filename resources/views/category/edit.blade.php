<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Modifier la catégorie : <span class="text-gray-800 font-bold dark:text-white">{{ $category->name }}</span></p>
        <button class="modal-close" data-modal="editCategory">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="editCategoryForm">
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded dark:bg-gray-800 dark:text-white" type="text" name="name" id="name" autocomplete="off" value="{{ $category->name }}">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button data-category-id="{{ $category->id }}" class="btn-update-category bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">Modifier</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="editCategory">Fermer</button>
    </div>
</div>