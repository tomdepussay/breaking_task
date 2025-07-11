<?php $currentView = 'calendar'; ?>

<div data-view="calendar" class="views hidden p-6">
    <div class="flex justify-between items-center mb-4">
        <div class="flex gap-2">
            <!-- Hidden element to ensure Tailwind includes 'btn-active' styles in the build -->
            <span class="hidden btn-active text-white"></span>
            <button data-view="day" class="view-btn btn-inactive px-3 py-1 rounded">Jour</button>
            <button data-view="week" class="view-btn btn-inactive px-3 py-1 rounded">Semaine</button>
            <button data-view="month" class="view-btn btn-inactive px-3 py-1 rounded">Mois</button>
        </div>
    </div>
    <div data-view="calendar" class="views hidden p-6" data-project-id="{{ $project->id }}">
        <div id="dayCalendarContainer"></div>
        <div id="weekCalendarContainer"></div>
        <div id="monthCalendarContainer"></div>
    </div>
</div>
@vite('resources/js/project/calendar-view.js')