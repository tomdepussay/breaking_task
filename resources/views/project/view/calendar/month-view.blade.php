<div data-calendar="month" class="calendar-view">
    <h2 class="text-xl font-semibold" id="calendarTitle">Mois</h2>
@php
    $currentDate = now();
    $startOfMonth = $currentDate->copy()->startOfMonth();
    $daysInMonth = $startOfMonth->daysInMonth;
    $firstDayOfWeek = ($startOfMonth->dayOfWeek + 6) % 7;
@endphp

<div class="grid grid-cols-7 gap-2 mt-4">
    @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $dayName)
        <div class="font-bold text-center">{{ $dayName }}</div>
    @endforeach

    @for ($i = 0; $i < $firstDayOfWeek; $i++)
        <div class="h-16"></div>
    @endfor

    @for ($day = 1; $day <= $daysInMonth; $day++)
        @php
            $date = $startOfMonth->copy()->addDays($day - 1);
            $isToday = $date->toDateString() === now()->toDateString();

            $dayString = $date->toDateString(); // format 'Y-m-d'
            $dayTasks = $project->tasks->filter(function ($task) use ($dayString) {
                return substr($task->deadline_at, 0, 10) === $dayString;
            });
        @endphp
        <div class="h-32 p-1 rounded overflow-auto {{ $isToday ? 'bg-blue-500 text-white' : 'bg-gray-100' }}">
            <div class="text-sm font-bold">{{ $day }}</div>
            @foreach ($dayTasks as $task)
                <div class="text-xs bg-black text-white p-1 rounded mt-1 shadow">
                    {{ $task->name }}
                </div>
            @endforeach
        </div>
    @endfor
</div>

</div>




