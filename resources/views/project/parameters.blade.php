<x-app-layout>
    <x-slot name="header" class="p-0">
        <a href="{{ route('project.show', ['id' => $project->id]) }}" class="flex items-center justify-start px-2 py-1 w-fit gap-1 text-sm rounded opacity-70 hover:opacity-90 hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left-icon lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
            <span>Retour</span>
        </a>
        <div id="{{ $project->id }}" class="project-name flex justify-between mt-2 mx-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Paramètre du projet <span id="project_name">{{ $project->name }}</span>
            </h2>
        </div>
    </x-slot>

    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">

    <div class="h-screen px-6 lg:px-32 py-6">
        <div class="bg-white rounded p-6">

            @php
                $currentTab = request('tab', 'general'); // 'general' par défaut
            @endphp
            
            @include('project.parameters.tabs')
            <hr>
            <div class="p-4">
                @include('project.parameters.tabs.general')
                @include('project.parameters.tabs.users')
                @include('project.parameters.tabs.columns')
                @include('project.parameters.tabs.categories')
                @include('project.parameters.tabs.priorities')
            </div>
        </div>
    </div>


</x-app-layout>
