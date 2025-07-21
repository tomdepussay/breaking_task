<li class="p-3 rounded-lg bg-white shadow flex justify-between items-start group hover:shadow-md transition">
    <div class="flex flex-col gap-2 w-full">
        <div class="flex gap-2 flex-wrap">
            @if ($task->priority)
                <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-700 font-medium">
                    {{ $task->priority->name }}
                </span>
            @endif
            @if ($task->category)
                <span class="text-xs px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 font-medium">
                    {{ $task->category->name }}
                </span>
            @endif
        </div>

        {{-- Nom de la tâche --}}
        <p class="text-sm text-gray-800 font-semibold">{{ $task->name }}</p>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-2 ml-4 shrink-0">
        <button class="btn-edit-task text-gray-500 hover:text-blue-600" data-task-id="{{ $task->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
            </svg>
        </button>
        <button class="btn-delete-task text-gray-500 hover:text-red-600" data-task-id="{{ $task->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                <path d="M3 6h18"/>
                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
            </svg>
        </button>
    </div>
</li>

<div class="modal" id="editTask"></div>
<div class="modal" id="deleteTask"></div>