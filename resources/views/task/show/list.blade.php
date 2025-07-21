<tr class="bg-white">
    <td class="border px-4 py-2">
        <div class="flex flex-col gap-1">
            <span class="font-semibold">{{ $task->name }}</span>

            <div class="flex flex-wrap gap-1 mt-1">
                @if ($task->priority)
                    <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 font-medium">
                        {{ $task->priority->name }}
                    </span>
                @endif
                @if ($task->category)
                    <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-medium">
                        {{ $task->category->name }}
                    </span>
                @endif
            </div>
        </div>
    </td>
    <td class="border px-4 py-2">{{ $task->description ?? '–' }}</td>
    <td class="border px-4 py-2">{{ $column->name }}</td>
    <td class="border px-4 py-2">{{ $task->due_date ? $task->due_date->format('d/m/Y') : '–' }}</td>
</tr>
