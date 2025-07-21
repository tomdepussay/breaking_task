<div data-view="table" class="views hidden py-4 md:px-6">
    <div class="overflow-scroll rounded-lg border-gray-300 md:overflow-hidden">
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
