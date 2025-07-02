<ul class="mt-6 w-full gap-3">
    @foreach ($project->users as $user)
        <li class="flex justify-start items-center gap-2 px-3 py-2">
            @if ($project->owner_id != $user->id && $user->id != auth()->user()->id)
                <div>
                    <button type="button" data-user-id="{{ $user->id }}" class="btn-delete-users bg-red-800 text-white p-2 rounded shadow-sm hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </div>
            @endif
            <div class="flex flex-col gap-0 justify-center items-start">
                <span class="text-lg font-semibold flex justify-start items-center gap-1">
                    {{ $user->firstname }} {{ $user->lastname }}
                    @if ($project->owner_id === $user->id)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FF5733" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown-icon lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                    @endif
                </span>
            </div>
        </li>
    @endforeach
</ul>