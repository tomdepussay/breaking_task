<div id="priorities" class="tab-container {{ $currentTab === 'priorities' ? '' : 'hidden' }}">
    <div class="">
        <div class="my-5">
            <button type="button" data-project-id="{{ $project->id }}" class="btn-create-priority  bg-dark text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Ajouter une priorité
            </button>
        </div>

        <div id="priorities-container">
            @include('project.parameters.tabs.priorities.priorities')
        </div>
    </div>
</div>

<div class="modal" id="createPriority"></div>
<div class="modal" id="editPriority"></div>
<div class="modal" id="deletePriority"></div>

@vite('resources/js/pages/priorities.js')

<script>
    const prioritiesRoutes = {
        "create": "{{ route('priority.create') }}",
        "store": "{{ route('priority.store') }}",
        "edit": "{{ route('priority.edit') }}",
        "update": "{{ route('priority.update') }}",
        "delete": "{{ route('priority.delete') }}",
        "destroy": "{{ route('priority.destroy') }}",
    }
</script>
