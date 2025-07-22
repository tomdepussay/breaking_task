<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Supprimer un utilisateur du projet</p>
        <button class="modal-close" data-modal="deleteUsers">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <span class="text-gray-800 font-bold dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</span> du projet <span class="text-gray-800 font-bold dark:text-white">{{ $project->name }}</span> ?</p>
    </div>
    <div class="modal-footer">
        <button data-user-id="{{ $user->id }}" class="btn-destroy-users bg-red-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">Oui, supprimer l'utilisateur du projet</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="deleteUsers">Non, fermer</button>
    </div>
</div>