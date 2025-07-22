@php
    use Carbon\Carbon;
@endphp

<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Confirmation de suppression</p>
        <button class="modal-close" data-modal="deleteTask">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
    <div class="modal-content">
        <p>Êtes-vous sûr de vouloir supprimer la tâche <span class="text-gray-800 font-bold dark:text-white">{{ $task->name }}</span> définitivement ?</p>
    </div>
    </div>
    <div class="modal-footer">
        <button data-task-id="{{ $task->id }}" class="btn-destroy-task transition-colors bg-secondaire/80 hover:bg-secondaire px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">Supprimer la tâche</button>
        <button class="modal-close px-3 py-2 rounded transition-colors bg-dark/80 hover:bg-dark text-white" data-modal="deleteTask">Fermer</button>
    </div>
</div>
