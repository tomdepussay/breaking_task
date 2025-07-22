<div data-view="table" class="views hidden px-6 py-4">
    <div class="overflow-hidden rounded-lg border-gray-300">
        <div class="mb-4">
            <input
                type="text"
                id="taskSearchInput"
                placeholder="Rechercher une tâche..."
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primaire"
            >
        </div>
        <table class="min-w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Colonne</th>
                    <th class="px-4 py-2 text-left">Date limite</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($project->columns as $column)
                    @foreach($column->tasks as $task)
                        @include('task/show/list', ['task' => $task, 'column' => $column])
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
