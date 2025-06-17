<x-app-layout>
    <x-slot name="header">
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
    </x-slot>

    <div class="py-8">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <ul id="columns-container"
                    class="p-6 text-gray-900 flex flex-nowrap items-start justify-start gap-2 overflow-x-auto">
                    @foreach($project->columns as $index => $column)
                    @include('column.show')
                    @endforeach
                    <li class="min-w-[300px] max-w-[300px] bg-white rounded flex-shrink-0">
                        <div class="p-3 flex items-center justify-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Ajouter une colonne
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal" id="addTask"></div>

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