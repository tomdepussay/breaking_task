<div class="mt-1 text-sm bg-white text-gray-800 p-3 rounded shadow flex justify-between items-center gap-4 dark:bg-gray-800 dark:text-white dark:border dark:border-gray-700">
    <div class="flex flex-col">
        <p class="font-semibold">{{ $task->name }}</p>

        @if ($task->priority)
            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded mt-1 dark:bg-gray-600 dark:text-white">
                Priorité : {{ $task->priority->name }}
            </span>
        @endif

        @if ($task->category)
            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded mt-1 dark:bg-indigo-600 dark:text-white">
                Catégorie : {{ $task->category->name }}
            </span>
        @endif
    </div>
</div>
