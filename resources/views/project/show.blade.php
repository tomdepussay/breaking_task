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

    <div class="flex h-[calc(100vh-6rem)]">
        <aside class="w-64 bg-gray-100 p-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Vues</h3>
            <nav class="flex flex-col gap-2">
                <button onclick="showView('kanban')" class="text-left text-gray-800 hover:underline">📋 Kanban</button>
                <button onclick="showView('list')" class="text-left text-gray-800 hover:underline">📑 Liste</button>
                <button onclick="showView('calendar')" class="text-left text-gray-800 hover:underline">📆 Calendrier</button>
            </nav>
        </aside>

        <div class="flex-1 overflow-y-auto bg-white max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div id="kanbanView">
                <div class="min-w-[300px] max-w-[300px] bg-white rounded flex-shrink-0">
                    <div class="p-3 flex items-center justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Ajouter une colonne
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <ul id="columns-container"
                    class="p-6 text-gray-900 flex flex-nowrap items-start justify-start gap-2 overflow-x-auto">
                        @foreach($project->columns as $index => $column)
                        @include('column.show')
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- VUE LISTE -->
            <div id="listView" class="hidden px-6 py-4">
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


            <!-- VUE CALENDRIER -->
            <div id="calendarView" class="hidden p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Vue Calendrier</h1>
                 <div class="flex justify-between items-center mb-4">
                    <div class="flex gap-2">
                        <button onclick="changeCalendarView('day')" class="px-3 py-1 bg-gray-200 rounded">Jour</button>
                        <button onclick="changeCalendarView('week')" class="px-3 py-1 bg-blue-600 text-white rounded">Semaine</button>
                        <button onclick="changeCalendarView('month')" class="px-3 py-1 bg-gray-200 rounded">Mois</button>
                    </div>
                    <h2 class="text-xl font-semibold" id="calendarTitle">Semaine actuelle</h2>
                </div>

                 <!-- Grille du calendrier -->
                <div class="grid grid-cols-8 border-t border-l text-sm text-gray-700">
                    <!-- Ligne des jours -->
                    <div class="border-b border-r h-12 flex items-center justify-center bg-gray-50">Heure</div>
                    @php
                        $days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
                    @endphp
                    @foreach($days as $day)
                        <div class="border-b border-r h-12 flex items-center justify-center bg-gray-50 font-medium">
                            {{ $day }}
                        </div>
                    @endforeach

                    <!-- Lignes horaires -->
                    @for ($hour = 8; $hour < 21; $hour++)
                        <!-- Heure -->
                        <div class="border-b border-r h-20 flex items-start justify-end pr-2 pt-1 text-xs bg-white">
                            {{ str_pad($hour, 1, '0', STR_PAD_LEFT) }}:00
                        </div>

                        <!-- 7 colonnes pour chaque jour -->
                        @for ($i = 0; $i < 7; $i++)
                            <div class="border-b border-r h-20 relative bg-white">
                                {{-- Les tâches apparaîtront ici --}}
                            </div>
                        @endfor
                    @endfor
                </div>
            </div>
        </div>

        <script>
            const tasks = [
                @foreach($project->columns as $column)
                    @foreach($column->tasks as $task)
                        {
                            name: @json($task->name),
                            due_date: @json($task->due_date),
                        },
                    @endforeach
                @endforeach
            ];

            document.addEventListener("DOMContentLoaded", () => {
                tasks.forEach(task => {
                    const date = new Date(task.due_date);
                    const day = (date.getDay() + 6) % 7; // Lundi = 0, Dimanche = 6
                    const hour = date.getHours();

                    // Ne garder que les heures entre 8h et 20h
                    if (hour < 8 || hour > 20) return;

                    const cell = document.querySelector(`.task-cell[data-day="${day}"][data-hour="${hour}"]`);
                    if (!cell) return;

                    const taskBlock = document.createElement("div");
                    taskBlock.className = "absolute top-1 left-1 right-1 bg-blue-500 text-white px-2 py-1 text-xs rounded shadow";
                    taskBlock.innerText = task.name;

                    cell.appendChild(taskBlock);
                });
            });

        </script>
    </div>

    <div class="modal" id="addTask"></div>

    <script>
    function showView(view) {
        document.getElementById('kanbanView').classList.add('hidden');
        document.getElementById('listView').classList.add('hidden');
        document.getElementById('calendarView').classList.add('hidden');

        document.getElementById(view + 'View').classList.remove('hidden');
    }
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

    function changeCalendarView(view) {
        alert("Changement de vue : " + view);
        // plus tard : activer d'autres vues
    }
    </script>

</x-app-layout>
