@php
    use Carbon\Carbon;
    Carbon::setLocale('fr');
    $monthName = Carbon::createFromDate($year, $month)->translatedFormat('F');
@endphp

<div data-calendar="month" class="calendar-view" data-year="{{ $year }}" data-month="{{ $month }}">
    <h2 class="text-xl font-semibold text-gray-800 mb-4" id="calendarTitle">
        {{ ucfirst($monthName) }} {{ $year }}
    </h2>

    <div class="flex gap-2 my-2">
        <button id="prevMonth" class="px-3 py-1 border-2 border-primaire rounded-lg text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ‹
        </button>
        <button id="nextMonth" class="px-3 py-1 border-2 border-primaire rounded-lg text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ›
        </button>
    </div>

    <div class="grid grid-cols-7 gap-1 mt-4 text-center border-t border-gray-300">
        @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $dayName)
            <div class="font-bold text-gray-700 border-b border-gray-300 py-1">{{ $dayName }}</div>
        @endforeach

        @for ($i = 0; $i < $firstDayOfWeek; $i++)
            <div class="h-32 border border-gray-300 bg-gray-50"></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateStr = $currentDate->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                $isToday = $dateStr === date('Y-m-d');

                $dayTasks = $project->tasks->filter(function ($task) use ($dateStr) {
                    return substr($task->deadline_at, 0, 10) === $dateStr;
                });
            @endphp
            <div class="h-32 p-2 rounded overflow-hidden flex flex-col border border-gray-300 {{ $isToday ? 'bg-primaire text-white shadow-lg border-primaire' : 'bg-white text-gray-800' }}">
                <div class="text-sm font-bold mb-1 sticky top-0 bg-inherit z-10 text-left">
                    {{ $day }}
                </div>
                <div class="overflow-y-auto flex-1">
                    @foreach ($dayTasks as $task)
                        @include('task/show/calendar', ['task' => $task])
                    @endforeach
                </div>
            </div>
        @endfor
    </div>
</div>
