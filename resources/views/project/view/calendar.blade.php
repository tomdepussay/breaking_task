<div data-view="calendar" class="views hidden p-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Vue Calendrier</h1>
     <div class="flex justify-between items-center mb-4">
        <div class="flex gap-2">
            <button onclick="changeCalendarView('day')" class="px-3 py-1 bg-gray-200 rounded">Jour</button>
            <button onclick="changeCalendarView('week')" class="px-3 py-1 bg-blue-600 text-white rounded">Semaine</button>
            <button onclick="changeCalendarView('month')" class="px-3 py-1 bg-gray-200 rounded">Mois</button>
        </div>
        <h2 class="text-xl font-semibold" id="calendarTitle">Semaine actuelle</h2>
    </div>

     <!-- Grille du calendrier -->
    <div class="grid grid-cols-8 border-t border-l text-sm text-gray-700">
        <!-- Ligne des jours -->
        <div class="border-b border-r h-12 flex items-center justify-center bg-gray-50">Heure</div>
        @php
            $days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        @endphp
        @foreach($days as $day)
            <div class="border-b border-r h-12 flex items-center justify-center bg-gray-50 font-medium">
                {{ $day }}
            </div>
        @endforeach

        <!-- Lignes horaires -->
        @for ($hour = 8; $hour < 21; $hour++)
            <!-- Heure -->
            <div class="border-b border-r h-20 flex items-start justify-end pr-2 pt-1 text-xs bg-white">
                {{ str_pad($hour, 1, '0', STR_PAD_LEFT) }}:00
            </div>

            <!-- 7 colonnes pour chaque jour -->
            @for ($i = 0; $i < 7; $i++)
                <div class="border-b border-r h-20 relative bg-white">
                    {{-- Les tâches apparaîtront ici --}}
                </div>
            @endfor
        @endfor
    </div>
</div>