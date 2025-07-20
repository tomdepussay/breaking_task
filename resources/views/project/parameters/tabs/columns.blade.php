<div id="columns" class="tab-container {{ $currentTab === 'columns' ? '' : 'hidden' }}">
    <div class="">
        <div class="my-5">
            <button type="button" data-project-id="{{ $project->id }}" class="btn-create-column  bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Ajouter une colonne
            </button>
        </div>

        <div id="columns-container">
            @include('project.parameters.tabs.columns.columns')
        </div>
    </div>
</div>

<div class="modal" id="createColumn"></div>
<div class="modal" id="editColumn"></div>
<div class="modal" id="deleteColumn"></div>

@vite([
    'resources/js/column/create.js',
    'resources/js/column/store.js',
    'resources/js/column/edit.js',
    'resources/js/column/update.js',
    'resources/js/column/delete.js',
    'resources/js/column/destroy.js',
    'resources/js/column/sort.js',
])

<script>
    const columnRoutes = {
        "create": "{{ route('column.create') }}",
        "store": "{{ route('column.store') }}",
        "edit": "{{ route('column.edit') }}",
        "update": "{{ route('column.update') }}",
        "delete": "{{ route('column.delete') }}",
        "destroy": "{{ route('column.destroy') }}",
        "sort": "{{ route('column.sort') }}",
    }
</script>
