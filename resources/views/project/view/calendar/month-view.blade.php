<div data-calendar="month" class="calendar-view" data-year="{{ $year }}" data-month="{{ $month }}">
    <h2 class="text-xl font-semibold" id="calendarTitle">
        {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}
    </h2>

    <div class="flex justify-between my-2">
        <button id="prevMonth" class="px-2 py-1 border rounded">‹</button>
        <button id="nextMonth" class="px-2 py-1 border rounded">›</button>
    </div>

    <div class="grid grid-cols-7 gap-2 mt-4">
        @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $dayName)
            <div class="font-bold text-center">{{ $dayName }}</div>
        @endforeach

        @for ($i = 0; $i < $firstDayOfWeek; $i++)
            <div class="h-16"></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateStr = $currentDate->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                $isToday = $dateStr === date('Y-m-d');

                $dayTasks = $project->tasks->filter(function ($task) use ($dateStr) {
                    return substr($task->deadline_at, 0, 10) === $dateStr;
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
