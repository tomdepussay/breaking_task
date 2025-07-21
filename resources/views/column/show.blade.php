<div class="p-3 flex items-align justify-between">
    <p>{{ $column->name }}</p>
    <div class="flex gap-2 items-center">
        <button class="btn-create-task" data-column-id="{{ $column->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </button>
    </div>
</div>
<hr>
<ul class="p-3 flex flex-col gap-2">
    @foreach ($column->tasks as $task)
        @include('task/show/kanban')
    @endforeach
</ul>