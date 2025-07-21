<div id="users" class="tab-container {{ $currentTab === 'users' ? '' : 'hidden' }}">
    <div class="">
        <div class="my-5">
            <button type="button" data-modal="createUsers" class="modal-open  bg-gray-700 text-white px-3 py-2 rounded shadow-sm hover:shadow-lg">
                Ajouter un utilisateur
            </button>
        </div>

        <div id="users-container">
            @include('project.parameters.tabs.users.users')
        </div>
    </div>
</div>

<div class="modal" id="createUsers">
    @include('project.parameters.tabs.users.create')
</div>

<div class="modal" id="deleteUsers"></div>

<script>
    const usersRoutes = {
        index: "{{ route('project.users.index') }}",
        search: "{{ route('project.users.search') }}",
        store: "{{ route('project.users.store') }}",
        delete: "{{ route('project.users.delete') }}",
        destroy: "{{ route('project.users.destroy') }}",
    };
</script>

@vite('resources/js/pages/parameters.js')
