@php
    use Carbon\Carbon;
@endphp

<div data-calendar="day" class="calendar-view" data-year="{{ $date->format('Y') }}" data-month="{{ $date->format('m') }}" data-day="{{ $date->format('d') }}">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">
        {{ ucfirst($date->locale('fr_FR')->isoFormat('dddd D MMMM YYYY')) }}
    </h2>

    <div class="flex gap-2 mb-4">
        <button id="prevDay" class="px-3 py-1 border-2 border-primaire rounded-lg text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ‹
        </button>
        <button id="nextDay" class="px-3 py-1 border-2 border-primaire rounded-lg text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ›
        </button>
    </div>

    <div class="max-h-[400px] overflow-y-auto space-y-3 bg-gray-100 p-4 rounded">
        @php
            $tasksForDay = $dayTasks->filter(function ($task) use ($date) {
                return $task->deadline_at && Carbon::parse($task->deadline_at)->isSameDay($date);
            });
        @endphp

        @forelse($tasksForDay as $task)
            @include('task/show/calendar', ['task' => $task])
        @empty
            <p class="text-gray-500 italic">Aucune tâche pour aujourd'hui.</p>
        @endforelse
    </div>
</div>
