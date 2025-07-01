<x-app-layout>
    <x-slot name="header" class="p-0">
        <div class="flex justify-between items-center">
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
        };

        const columnRoutes = {
            show: "{{ route('column.show') }}",
        };
    </script>

    @vite([
        'resources/js/task/create.js',
        'resources/js/task/store.js',
        'resources/js/column/reload.js',
        'resources/js/project/view.js'
    ])


    <script>
        function addTask() {
            let form = document.getElementById('addTaskForm');

            let name = form.name.value;
            let description = form.description.value;
            let column_id = form.column_id.value;
            let category_id = form.category_id.value;
            let priority_id = form.priority_id.value;
            let due_date = form.due_date.value;

            let formData = new FormData(form);
            let project_id = document.querySelector('.project-name').id;

            formData.append('name', name);
            formData.append('description', description);
            formData.append('column_id', column_id);
            formData.append('category_id', category_id);
            formData.append('priority_id', priority_id);
            formData.append('due_date', due_date);
            formData.append('project_id', project_id);

            fetch(`{{ route('task.store') }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur lors de l\'ajout de la tâche');
                    return response.json();
                })
                .then(data => {
                    let modal = document.getElementById('addTask');
                    modal.style.display = 'none';

                    let column = document.querySelector(`li[data-column="${data.column_id}"] ul`);
                    let taskHtml = `<li class="task-item">${data.name}</li>`;
                    column.insertAdjacentHTML('beforeend', taskHtml);
                })
                .catch(error => {
                    console.error(error);
                });
        }

    function openAddTask(column_id, project_id) {
        fetch(`{{ route('task.create') }}?id=${column_id}&project_id=${project_id}`)
            .then(response => {
                if (!response.ok) throw new Error('Erreur lors de la récupération du formulaire');
                return response.text();
            })
            .then(data => {
                let modal = document.getElementById('addTask');
                modal.innerHTML = data;
                modal.style.display = 'flex';
            })
            .catch(error => {
                console.log(error);
            })
    }
    </script>

</x-app-layout>
