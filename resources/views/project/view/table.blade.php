<div data-view="table" class="views hidden px-6 py-4">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Vue Liste</h2>
    <div class="overflow-hidden rounded-lg border-gray-300">
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
