<div data-view="table" class="views hidden px-6 py-4">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Vue Liste</h2>
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2 text-left">Titre</th>
                <th class="border px-4 py-2 text-left">Description</th>
                <th class="border px-4 py-2 text-left">Colonne</th>
                <th class="border px-4 py-2 text-left">Date limite</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->columns as $column)
                @foreach($column->tasks as $task)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $task->name }}</td>
                        <td class="border px-4 py-2">{{ $task->description ?? '–' }}</td>
                        <td class="border px-4 py-2">{{ $column->name }}</td>
                        <td class="border px-4 py-2">{{ $task->due_date ?? '–' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>