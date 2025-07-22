<ul class="mt-6 mx-6 flex flex-col md:grid md:grid-cols-3 md:gap-3">
    @forelse ($projects as $project)
        <a href="{{ route('project.show', ['id' => $project->id]) }}" class="border border-primaire group p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 flex items-center justify-between cursor-pointer">
            <h3 class="flex items-center gap-2 font-semibold">
                @if ($project->owner_id === Auth::id())
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FF5733" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown-icon lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                @endif
                {{ $project->name }}
            </h3>
            <div class="flex items-center gap-2">
                @if ($project->owner_id != Auth::id())
                    <button data-project-id="{{ $project->id }}" class="btn-leave-project text-red-800 opacity-0 invisible cursor-pointer transition-all duration-100 delay-500 group-hover:opacity-100 group-hover:visible">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>                    
                    </button>
                @endif
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
            </div>
        </a>
    @empty
        <span>Aucun projet</span>
    @endforelse
</ul>