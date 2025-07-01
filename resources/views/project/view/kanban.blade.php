<div data-view="kanban" class="views flex-1 overflow-auto bg-gray-100/50 max-w-8xl mx-auto">
    <ul id="columns-container" class="p-6 text-gray-900 flex flex-nowrap items-start justify-start gap-2">
        @foreach($project->columns as $index => $column)
            <li data-column="{{ $column->id }}" class="min-w-[300px] max-w-[300px] bg-white rounded flex-shrink-0 columns">
                @include('column.show')
            </li>
        @endforeach
        <li class="min-w-[300px] max-w-[300px] bg-white rounded flex-shrink-0">
            <div class="p-3 flex items-center justify-start gap-2 mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter une colonne
            </div>
        </li>
    </ul>
</div>