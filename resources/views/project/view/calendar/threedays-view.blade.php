@php
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;

    $startDate = $date->copy();
    $endDate = $date->copy()->addDays(2);
    $threeDaysPeriod = CarbonPeriod::create($startDate, $endDate);
@endphp

<div data-calendar="threedays" class="calendar-view" data-year="{{ $date->format('Y') }}" data-month="{{ $date->format('m') }}" data-day="{{ $date->format('d') }}">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">
        {{ ucfirst($startDate->locale('fr_FR')->isoFormat('dddd D MMMM')) }} – {{ ucfirst($endDate->locale('fr_FR')->isoFormat('dddd D MMMM YYYY')) }}
    </h2>

    <div class="flex gap-2 mb-4">
        <button id="prevThreeDays" class="px-3 py-1 border-2 border-primaire rounded-full text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ‹
        </button>
        <button id="nextThreeDays" class="px-3 py-1 border-2 border-primaire rounded-full text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ›
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 min-h-[300px]">
        @foreach($threeDaysPeriod as $day)
            @php
                $formattedDate = $day->format('Y-m-d');
                $tasksForDay = $threeDaysTasks->filter(function ($task) use ($day) {
                    return $task->deadline_at && Carbon::parse($task->deadline_at)->isSameDay($day);
                });

                $isToday = $formattedDate === now()->format('Y-m-d');
            @endphp

            <div class="bg-white rounded p-4 shadow {{ $isToday ? 'border-2 border-primaire' : '' }}">
                <div class="text-sm font-bold mb-2 text-gray-700">
                    {{ ucfirst($day->locale('fr_FR')->isoFormat('dddd D MMMM')) }}
                </div>

                <div class="max-h-[300px] overflow-y-auto space-y-3">
                    @forelse($tasksForDay as $task)
                        @include('task/show/calendar', ['task' => $task])
                    @empty
                        <p class="text-gray-500 italic">Aucune tâche.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>

