<div class="flex justify-evenly items-center gap-2 mb-4 text-lg overflow-x-scroll md:overflow-x-auto">
    @if($project->owner_id === Auth::id())
        <button data-tab="general" class="tab p-2 px-4 rounded hover:bg-gray-100/50 underline-offset-4 {{ $currentTab === 'general' ? 'underline bg-gray-100/50' : '' }}">
            Paramètre du projet
        </button>
        <button data-tab="users" class="tab p-2 px-4 rounded hover:bg-gray-100/50 underline-offset-4 {{ $currentTab === 'users' ? 'underline bg-gray-100/50' : '' }}">
            Utilisateurs
        </button>
    @endif
    <button data-tab="columns" class="tab p-2 px-4 rounded hover:bg-gray-100/50 underline-offset-4 {{ $currentTab === 'columns' ? 'underline bg-gray-100/50' : '' }}">
        Colonnes
    </button>
    <button data-tab="categories" class="tab p-2 px-4 rounded hover:bg-gray-100/50 underline-offset-4 {{ $currentTab === 'categories' ? 'underline bg-gray-100/50' : '' }}">
        Catégories
    </button>
    <button data-tab="priorities" class="tab p-2 px-4 rounded hover:bg-gray-100/50 underline-offset-4 {{ $currentTab === 'priorities' ? 'underline bg-gray-100/50' : '' }}">
        Priorités
    </button>
</div>