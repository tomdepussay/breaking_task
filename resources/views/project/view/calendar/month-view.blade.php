<div data-calendar="month" class="calendar-view">
    <h2 class="text-xl font-semibold" id="calendarTitle">Mois</h2>
    <!-- @TODO: Refactor the monthly calendar -->
    <!-- Grille du calendrier M -->
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
        @for ($hour = 8; $hour < 21; $hour++) <!-- Heure -->
            <div class="border-b border-r h-20 flex items-start justify-end pr-2 pt-1 text-xs bg-white">
                {{ str_pad($hour, 1, '0', STR_PAD_LEFT) }}:00
            </div>

            <!-- 7 colonnes pour chaque jour -->
            @for ($i = 0; $i < 7; $i++) <div class="border-b border-r h-20 relative bg-white">
                {{-- Les tâches apparaîtront ici --}}

    </div>
    @endfor
    @endfor
</div>