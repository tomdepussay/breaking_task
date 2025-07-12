<div data-calendar="day" class="calendar-view" data-year="{{ $date->format('Y') }}" data-month="{{ $date->format('m') }}" data-day="{{ $date->format('d') }}">
    <h2 class="text-xl font-semibold mb-2">
        {{ ucfirst($date->locale('fr_FR')->isoFormat('dddd D MMMM YYYY')) }}
    </h2>

    <div class="flex justify-between mb-4">
        <button id="prevDay" class="px-2 py-1 border rounded">‹</button>
        <button id="nextDay" class="px-2 py-1 border rounded">›</button>
    </div>

    <div>
        @forelse($dayTasks as $task)
            <div class="mt-1 text-sm bg-black text-white p-2 rounded shadow">
                {{ $task->name }}
            </div>
        @empty
            <p class="text-gray-500">Aucune tâche pour aujourd'hui.</p>
        @endforelse
    </div>
</div>