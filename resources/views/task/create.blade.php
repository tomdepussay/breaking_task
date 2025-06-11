<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Ajouter une tâche</p>
        <button class="modal-close" data-modal="addTask">
    </div>
    <div class="modal-content">
        <form action="" id="addTaskForm">
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded" type="text" name="name" id="name">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg" onclick="addTask()">Ajouter une tâche</button>
        <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="addTask">Fermer</button>
    </div>
</div>