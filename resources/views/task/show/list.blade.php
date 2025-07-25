<?php use Carbon\Carbon; ?>

<tr
    class="bg-white dark:bg-gray-700 dark:text-white"
    data-search="{{ strtolower($task->name . ' ' . ($task->description ?? '') . ' ' . $column->name . ' ' . ($task->priority->name ?? '') . ' ' . ($task->category->name ?? '')) }}"
>
    <td class="border px-4 py-2 dark:border-gray-600">
        <div class="flex flex-col gap-1">
            <span class="font-semibold">{{ $task->name }}</span>

            <div class="flex flex-wrap gap-1 mt-1">
                @if ($task->priority)
                    <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 font-medium dark:bg-gray-600 dark:text-white">
                        {{ $task->priority->name }}
                    </span>
                @endif
                @if ($task->category)
                    <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-medium dark:bg-indigo-600 dark:text-white">
                        {{ $task->category->name }}
                    </span>
                @endif
            </div>
        </div>
    </td>
    <td class="border px-4 py-2 dark:border-gray-600">{{ $task->description ?? '–' }}</td>
    <td class="border px-4 py-2 dark:border-gray-600">{{ $column->name }}</td>
    <td class="border px-4 py-2 dark:border-gray-600">{{ $task->deadline_at ? Carbon::parse($task->deadline_at)->format('d/m/Y') : '–' }}</td>
</tr>
