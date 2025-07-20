<div id="general" class="tab-container {{ $currentTab === 'general' ? '' : 'hidden' }}">
    <div class="flex flex-col gap-1">
        <label for="input_project_name">Nom du projet :</label>
        <div class="flex gap-2">
            <input class="rounded" type="text" id="input_project_name" name="project_name" value="{{ $project->name }}">
            <button id="btn-update-project" type="button" class="bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Modifier le nom
            </button>
        </div>
    </div>

    <div class="mt-16">
        <button type="button" id="btn-delete-project" class="bg-red-800 px-3 py-2 rounded text-white shadow-sm hover:shadow-lg">
            Supprimer le projet
        </button>
    </div>
</div>

<div class="modal" id="deleteProject"></div>

<script>
    const projectRoutes = {
        update: "{{ route('project.update') }}",
        delete: "{{ route('project.delete') }}",
        destroy: "{{ route('project.destroy') }}",
    };

    const dashboard = "{{ route('dashboard') }}";
</script>

@vite('resources/js/pages/parameters.js')
