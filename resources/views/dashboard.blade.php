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
                        <h2 class="text-lg">Projets</h2>
                        <button data-modal="addProject" class="modal-open flex items-center gap-2 px-3 py-2 bg-gray-800 text-white rounded shadow-sm hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            Ajouter un projet
                        </button>
                    </div>

                    <div id="projects-container"></div>

                    <div class="modal" id="editProject"></div>
                    <div class="modal" id="deleteProject"></div>

                    <div class="modal" id="addProject">
                        <div class="modal-container">
                            <div class="modal-header">
                                <p class="modal-title">Ajouter un projet</p>
                                <button class="modal-close" data-modal="addProject">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>
                            </div>

                            <div class="modal-content">
                                <form action="" id="addProjectForm">
                                    <div class="flex flex-col gap-2">
                                        <label for="name">Nom :</label>
                                        <input class="rounded" type="text" name="name" id="name">
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button class="bg-gray-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg" onclick="addProject()">Ajouter un projet</button>
                                <button class="modal-close px-3 py-2 rounded bg-gray-800/90 text-white" data-modal="addProject">Fermer</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openDeleteProject(project_id){
            fetch(`{{ route('project.delete') }}?id=${project_id}`)
            .then(response => {
                if(!response.ok) throw new Error('Erreur lors du chargement du modal');
                return response.text();
            })
            .then(data => {
                let modal = document.getElementById('deleteProject');
                modal.innerHTML = data;
                modal.style.display = "flex";
            })
            .catch(error => {
                console.log(error);
            })
        }
        
        function deleteProject(project_id){
            let formData = new FormData();
            formData.append('id', project_id);
        
            fetch("{{ route('project.delete') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => {
                if(!response.ok) throw new Error("Erreur lors de la suppression du projet");
                return response.json();
            })
            .then(data => {
                reloadProjects();
                document.querySelector(".modal-close[data-modal='deleteProject']").click();
            })
            .catch(error => {
                console.log(error);
            })
        }
        
        function openEditProject(project_id){
            fetch(`{{ route('project.edit') }}?id=${project_id}`)
            .then(response => {
                if(!response.ok) throw new Error('Erreur lors du chargement du modal');
                return response.text();
            })
            .then(data => {
                let modal = document.getElementById('editProject');
                modal.innerHTML = data;
                modal.style.display = "flex";
            })
            .catch(error => {
                console.log(error);
            })
        }
        
        function editProject(project_id){
            let form = document.getElementById("editProjectForm");
            let name = form.name.value;
        
            let formData = new FormData();
            formData.append('id', project_id);
            formData.append('name', name);
        
            fetch("{{ route('project.edit') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => {
                if(!response.ok) throw new Error("Erreur lors de la modification du projet");
                return response.json();
            })
            .then(data => {
                reloadProjects();
                form.reset();
                document.querySelector(".modal-close[data-modal='editProject']").click();
            })
            .catch(error => {
                console.log(error);
            })
        }
        
        function reloadProjects(){
            fetch("{{ route('projects.list') }}")
            .then(response => {
                if(!response.ok) throw new Error('Erreur lors de la récupération des données');
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
        
        function addProject(){
            let form = document.getElementById("addProjectForm");
            let name = form.name.value;
        
            let formData = new FormData();
            formData.append('name', name);
        
            fetch("{{ route('project.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => {
                if(!response.ok) throw new Error("Erreur lors de l'ajout du projet");
                return response.json();
            })
            .then(data => {
                reloadProjects();
                form.reset();
                document.querySelector(".modal-close[data-modal='addProject']").click();
            })
            .catch(error => {
                console.log(error);
            })
        }

        reloadProjects();
    </script>
</x-app-layout>
