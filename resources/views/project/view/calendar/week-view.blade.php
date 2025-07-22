@php
use Carbon\CarbonPeriod;
use Carbon\Carbon;
@endphp

<div data-calendar="week" class="calendar-view" data-current-date="{{ $startOfWeek->format('Y-m-d') }}">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 dark:text-white">
        Semaine du {{ $startOfWeek->format('d/m/Y') }} au {{ $endOfWeek->format('d/m/Y') }}
    </h2>

    <div class="flex gap-2 my-2">
        <button id="prevWeek" class="px-3 py-1 border-2 border-primaire rounded-full text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ‹
        </button>
        <button id="nextWeek" class="px-3 py-1 border-2 border-primaire rounded-full text-primaire font-semibold shadow-sm hover:bg-primaire hover:text-white transition-colors duration-300 ease-in-out">
            ›
        </button>
    </div>

    <div class="flex flex-col gap-1 mt-4 border-gray-300 text-center md:grid grid-cols-7 min-h-[300px]">
        @foreach(CarbonPeriod::create($startOfWeek, $endOfWeek) as $date)
            @php
                $isToday = $date->format('Y-m-d') === date('Y-m-d');
                $dayTasks = $weekTasks->filter(function ($task) use ($date) {
                    if (!$task->deadline_at) return false;

                    $taskDate = Carbon::parse($task->deadline_at)->timezone('Europe/Paris');
                    $currentDate = $date->copy()->timezone('Europe/Paris');

                    return $taskDate->isSameDay($currentDate);
                });
            @endphp
            <div class="p-3 rounded flex flex-col border border-gray-300 {{ $isToday ? 'bg-primaire text-white shadow-lg border-primaire' : 'bg-white text-gray-800' }} dark:bg-gray-800 dark:text-white">
                <div class="font-bold mb-2 text-left sticky top-0 bg-inherit z-10">
                    {{ ucfirst($date->locale('fr')->isoFormat('dddd D MMM')) }}
                </div>
                <div class="overflow-y-auto flex-1">
                    @foreach($dayTasks as $task)
                        @include('task/show/calendar', ['task' => $task])
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
