@if (! auth()->user()->hasVerifiedEmail())
<div id="verify-modal" class="fixed inset-0 bg-black/50 flex justify-center items-center animate-fade-in">
    <div class="bg-white p-6 rounded shadow max-w-sm text-center space-y-4">
        <h2 class="text-xl font-bold text-red-600">Email non vérifié</h2>
        <p class="text-gray-700">Merci de vérifier votre email pour activer votre compte.</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="mt-2 px-4 py-2 bg-secondaire/80 hover:bg-secondaire text-white rounded shadow">
                Renvoyer l’email
            </button>
        </form>
        <button onclick="document.getElementById('verify-modal').classList.add('hidden')"
            class="text-sm text-gray-500 hover:underline">Fermer</button>
    </div>
</div>
@endif
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">Projets</h2>
                        <button data-modal="createProject" class="modal-open flex items-center gap-2 px-3 py-2 bg-secondaire text-white rounded shadow-sm hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"> <path d="M5 12h14" /> <path d="M12 5v14" /></svg>
                            Ajouter un projet
                        </button>
                    </div>

                    <div id="projects-container"></div>

                    <div class="modal" id="leaveProject"></div>
                    <div class="modal" id="createProject">
                        @include('project.create')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/pages/dashboard.js')

    <script>
        const projectRoutes = {
            index: "{{ route('project.index') }}",
            store: "{{ route('project.store') }}",
            leave: "{{ route('project.leave') }}",
            quit: "{{ route('project.quit') }}",
        };

        document.addEventListener('DOMContentLoaded', function() {
            reloadProjects();
        });
    </script>
</x-app-layout>
