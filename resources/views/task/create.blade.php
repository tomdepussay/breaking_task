<div class="modal-container">
    <div class="modal-header">
        <p class="modal-title">Ajouter une tâche</p>
        <button class="modal-close" data-modal="createTask">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
        </button>
    </div>
    <div class="modal-content">
        <form action="" id="createTaskForm">
            <!-- Name -->
            <div class="flex flex-col gap-2">
                <label for="name">Nom :</label>
                <input value="{{ $name }}" class="rounded" type="text" name="name" id="name">
            </div>
            <!-- Description -->
            <div class="flex flex-col gap-2">
                <label for="name">Description :</label>
                <textarea class="rounded h-24 resize-none" type="text" name="description" id="description"></textarea>
            </div>
            <!-- Column -->
            <div class="flex flex-col gap-2">
                <label for="column_id">Colonne :</label>
                <select name="column_id" id="column_id" class="rounded">
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
                <select name="category_id" id="category_id" class="rounded">
                    <option value="" disabled selected>Choisir une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-4">
                <!-- Priority -->
                <div class="flex flex-col gap-2 w-1/2">
                    <label for="priority_id">Priorité :</label>
                    <select name="priority_id" id="priority_id" class="rounded">
                        <option value="" disabled selected>Choisir une priorité</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Due date -->
                <div class="flex flex-col gap-2 w-1/2">
                    <label for="due_date">Date d'échéance :</label>
                    <div class="relative">
                        <input class="rounded w-full pr-10" type="date" name="due_date" id="due_date">
                        <button type="button" onclick="document.getElementById('due_date').value = ''"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-500">
                            ✖
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-store-task transition-colors bg-secondaire/80 hover:bg-secondaire px-3 py-2 rounded text-white shadow-sm">
            Ajouter une tâche
        </button>
        <button type="button" class="modal-close px-3 py-2 rounded transition-colors bg-dark/80 hover:bg-dark text-white" data-modal="createTask">
            Fermer
        </button>
    </div>
</div>