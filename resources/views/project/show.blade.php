<x-app-layout>
    <x-slot name="header" class="p-0">
        <div class="flex justify-between items-center">
            <div class="flex justify-center items-center gap-6">
                <div>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center justify-start px-2 py-1 w-fit gap-1 text-sm rounded opacity-70 hover:opacity-90 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-left-icon lucide-chevron-left">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                        <span>Retour</span>
                    </a>
                    <div id="{{ $project->id }}" class="project-name flex justify-between mt-2 mx-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $project->name }}
                        </h2>
                    </div>
                </div>
                <div class="flex justify-between items-center gap-6 font-semibold">
                    <button data-view="kanban" class="change-view flex flex-col justify-center items-center gap-2 p-2 rounded bg-gray-100/50 underline hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-kanban-icon lucide-square-kanban"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 7v7"/><path d="M12 7v4"/><path d="M16 7v9"/></svg>
                        Kanban
                    </button>
                    <button data-view="table" class="change-view flex flex-col justify-center items-center gap-2 p-2 rounded bg-gray-100/50 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-table-icon lucide-table"><path d="M12 3v18"/><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/></svg>
                        Tableau
                    </button>
                    <button data-view="calendar" class="change-view flex flex-col justify-center items-center gap-2 p-2 rounded bg-gray-100/50 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-icon lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                        Calendrier
                    </button>
                </div>
            </div>
            <div>
                <a href="{{ route('project.parameters', ['id' => $project->id]) }}" class="flex flex-col justify-center items-center gap-2 p-2 rounded bg-gray-100/50 hover:bg-gray-100 font-semibold underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Paramètres
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-6 py-0">
        @include('project.view.kanban')
        @include('project.view.table')
        @include('project.view.calendar')
    </div>

    <div class="modal" id="createTask"></div>

    <script>
        const taskRoutes = {
            create: "{{ route('task.create') }}",
            store: "{{ route('task.store') }}",
            edit: "{{ route('task.edit') }}",
            update: "{{ route('task.update') }}",
        };

        const columnRoutes = {
            show: "{{ route('column.show') }}",
        };
    </script>

    @vite([
        'resources/js/task/create.js',
        'resources/js/task/store.js',
        'resources/js/task/edit.js',
        'resources/js/column/reload.js',
        'resources/js/project/view.js',
        'resources/js/project/calendar/reload.js',
        'resources/js/project/calendar/navigation.js',
    ])
</x-app-layout>
