<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Modifier le projet : <span class="text-gray-800 font-bold">{{ $project->name }}</span></p>
        <button class="modal-close" data-modal="editProject">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="editProjectForm">
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded" type="text" name="name" id="name" value="{{ $project->name }}">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg" onclick="editProject({{ $project->id }})">Modifier le projet</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="editProject">Fermer</button>
    </div>
</div>