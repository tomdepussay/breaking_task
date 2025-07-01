<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Ajouter un collaborateur</p>
        <button class="modal-close" data-modal="createUsers">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"> <path d="M18 6 6 18" /> <path d="m6 6 12 12" /></svg>
        </button>
    </div>
    <div class="modal-content">

        <div class="flex justify-start items-center gap-2">
            <input type="text" name="search" id="search" class="rounded w-full" placeholder="Rechercher un utilisateur">
            <button type="button" id="btn-search" class="bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Rechercher
            </button>
        </div>

        <ul class="h-80 mt-6 flex flex-col justify-start items-center w-full px-2 gap-3" id="search-container">
            <li>Aucun résultat</li>
        </ul>

    </div>
    <div class="modal-footer">
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="createUsers">Fermer</button>
    </div>
</div>