@php
    use Carbon\Carbon;
@endphp

<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Modifier la tâche : <span class="text-gray-800 font-bold dark:text-white">{{ $task->name }}</span></p>
        <button class="modal-close" data-modal="editTask">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="editTaskForm">
            <!-- Name -->
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input class="rounded dark:bg-gray-800 dark:text-white" type="text" name="name" id="name" autocomplete="off" value="{{ $task->name }}">
            </div>
            <!-- Description -->
            <div class="flex flex-col gap-2 mt-2">
                <label for="name">Description :</label>
                <textarea class="rounded p-2 h-24 resize-none dark:bg-gray-800 dark:text-white" name="description" id="description" autocomplete="off">{{ $task->description }}</textarea>
            </div>
            <!-- Column -->
             <div class="flex flex-col gap-2">
                <label for="column_id">Colonne :</label>
                <select name="column_id" id="column_id" class="rounded dark:bg-gray-800 dark:text-white">
                    @foreach($columns as $column)
                        <option value="{{ $column->id }}" {{ $column->id == $id_column ? 'selected' : '' }}>
                            {{ $column->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Category -->
            <div class="flex flex-col gap-2">
                <label for="category_id">Catégorie :</label>
                <select name="category_id" id="category_id" class="rounded dark:bg-gray-800 dark:text-white">
                    <option value="" disabled selected>Choisir une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $task->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-4">
                <!-- Priority -->
                <div class="flex flex-col gap-2 w-1/2">
                    <label for="priority_id">Priorité :</label>
                    <select name="priority_id" id="priority_id" class="rounded dark:bg-gray-800 dark:text-white">
                        <option value="" disabled selected>Choisir une priorité</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ $priority->id == $task->priority_id ? 'selected' : '' }}>{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Due date -->
                <div class="flex flex-col gap-2 w-1/2">
                    <label for="deadline_at">Date d'échéance :</label>
                    <div class="relative">
                        <input class="rounded w-full pr-10 dark:bg-gray-800 dark:text-white" type="date" name="deadline_at" id="deadline_at" value="{{ $task->deadline_at ? Carbon::parse($task->deadline_at)->format('Y-m-d') : '' }}" autocomplete="off">
                        <button type="button" onclick="document.getElementById('deadline_at').value = ''"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                            ✖
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button data-task-id="{{ $task->id }}" class="btn-update-task transition-colors bg-secondaire/80 hover:bg-secondaire px-3 py-2 rounded text-white shadow-sm">Modifier la tâche</button>
        <button class="modal-close px-3 py-2 rounded transition-colors bg-dark/80 hover:bg-dark text-white" data-modal="editTask">Fermer</button>
    </div>
</div>
