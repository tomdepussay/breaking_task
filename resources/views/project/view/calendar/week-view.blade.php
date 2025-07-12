@php
use Carbon\CarbonPeriod;
use Carbon\Carbon;
@endphp

<div data-calendar="week" class="calendar-view" data-current-date="{{ $startOfWeek->format('Y-m-d') }}">
    <h2 class="text-xl font-semibold">
        Semaine du {{ $startOfWeek->format('d/m/Y') }} au {{ $endOfWeek->format('d/m/Y') }}
    </h2>

    <div class="flex justify-between my-2">
        <button id="prevWeek" class="px-2 py-1 border rounded">‹</button>
        <button id="nextWeek" class="px-2 py-1 border rounded">›</button>
    </div>

    <div class="grid grid-cols-7 gap-2 mt-4">
        @foreach(CarbonPeriod::create($startOfWeek, $endOfWeek) as $date)
            <div class="h-48 p-2 bg-gray-100 rounded overflow-auto">
                <div class="font-bold">{{ ucfirst($date->locale('fr')->isoFormat('dddd D MMM')) }}</div>

                @php
                    $dateStr = $date->format('Y-m-d');
                    $dayTasks = $weekTasks->filter(fn($task) => substr($task->deadline_at, 0, 10) === $dateStr);
                @endphp

                @foreach($dayTasks as $task)
                    <div class="mt-1 text-xs bg-black text-white p-1 rounded shadow">
                        {{ $task->name }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
