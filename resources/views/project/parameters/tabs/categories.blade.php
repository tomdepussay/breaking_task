<div id="categories" class="tab-container {{ $currentTab === 'categories' ? '' : 'hidden' }}">
    <div class="">
        <div class="my-5">
            <button type="button" data-project-id="{{ $project->id }}" class="btn-create-category  bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Ajouter une catégorie
            </button>
        </div>

        <div id="categories-container">
            @include('project.parameters.tabs.categories.categories')
        </div>
    </div>
</div>

<div class="modal" id="createCategory"></div>
<div class="modal" id="editCategory"></div>
<div class="modal" id="deleteCategory"></div>

@vite([
    'resources/js/category/create.js',
    'resources/js/category/store.js',
    'resources/js/category/edit.js',
    'resources/js/category/update.js',
    'resources/js/category/delete.js',
    'resources/js/category/destroy.js',
])

<script>
    const categoriesRoutes = {
        "create": "{{ route('category.create') }}",
        "store": "{{ route('category.store') }}",
        "edit": "{{ route('category.edit') }}",
        "update": "{{ route('category.update') }}",
        "delete": "{{ route('category.delete') }}",
        "destroy": "{{ route('category.destroy') }}",
    }
</script>