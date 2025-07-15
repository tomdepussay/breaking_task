<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Projets</h2>
                        <button data-modal="createProject" class="modal-open flex items-center gap-2 px-3 py-2 bg-gray-800 text-white rounded shadow-sm hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"> <path d="M5 12h14" /> <path d="M12 5v14" /></svg>
                            Ajouter un projet
                        </button>
                    </div>

                    <div id="projects-container"></div>

                    <div class="modal" id="leaveProject"></div>
                    <div class="modal" id="createProject">
                        @include('project.create')
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        // PROJECT RELOAD
        window.reloadProjects = function() {
            fetch(projectRoutes.index)
                .then(response => {
                    if (!response.ok) throw new Error('Erreur lors de la récupération des données');
                    return response.text();
                })
                .then(data => {
                    let container = document.getElementById('projects-container');
                    container.innerHTML = data;
                })
                .catch(error => {
                    console.log(error);
                })
        }

        // PROJECT LEAVE
        document.addEventListener('click', function(e) {
            let button = e.target.closest('.btn-leave-project');
            if(!button) return;

            e.stopPropagation();
            e.preventDefault();

            let projectId = button.getAttribute('data-project-id');

            fetch(`${projectRoutes.leave}?project_id=${projectId}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur lors de la récupération des données");
                    return response.text();
                })
                .then(data => {
                    let modal = document.getElementById('leaveProject');
                    modal.innerHTML = data;
                    modal.style.display = 'flex';
                })
                .catch(error => {
                    console.log(error);
                })
        });

        // PROECT QUIT
        document.addEventListener('click', function (e){
            let button = e.target.closest('.btn-quit-project');
            if(!button) return;

            let project_id = button.getAttribute('data-project-id');

            let formData = new FormData;
            formData.append('project_id', project_id);

            fetch(`${projectRoutes.quit}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur lors de la mise à jour');
                    return response.json();
                })
                .then(data => {
                    reloadProjects();
                    document.querySelector(".modal-close[data-modal='leaveProject']").click();
                })
                .catch(error => {
                    console.log(error);
                })
        })

        const projectRoutes = {
            index: "{{ route('project.index') }}",
            store: "{{ route('project.store') }}",
            leave: "{{ route('project.leave') }}",
            quit: "{{ route('project.quit') }}",
        };

        document.addEventListener('DOMContentLoaded', function() {
            reloadProjects();
        });
    </script>
@endpush
</x-app-layout>
