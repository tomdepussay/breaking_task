@foreach ($users as $user)
    <li class="flex justify-start items-center gap-2 w-full">
        <div>
            <button type="button" data-user-id="{{ $user->id }}" class="btn-store-users bg-gray-700 text-white p-2 rounded shadow-sm hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14" /><path d="M12 5v14" /></svg>
            </button>
        </div>
        <div class="flex flex-col gap-0 justify-center items-start">
            <span class="text-lg font-semibold flex justify-start items-center gap-1">
                {{ $user->firstname }} {{ $user->lastname }} ({{ $user->email }})
            </span>
        </div>
    </li>
@endforeach