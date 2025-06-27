<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-light text-text font-base flex p-6 lg:p-8 items-center lg:justify-center flex-col">

        <header class="w-full border-b border-gray-300">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                <div class="text-2xl font-title text-dark">
                    <x-application-logo class="inline-block w-10 h-10" />
                    Breaking Task
                </div>
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4 text-sm">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-4 py-2 text-white bg-secondaire hover:bg-dark rounded-md transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 bg-dark text-white hover:bg-secondaire rounded-md transition">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 bg-dark text-white hover:bg-secondaire rounded-md transition">
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <section class="py-20 bg-light">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-title text-dark mb-6 leading-tight">
                    Organisez vos projets <span class="text-secondaire">comme jamais auparavant</span>
                </h1>
                <p class="text-lg text-text font-important mb-8">
                    Gérez vos tâches, votre équipe et vos délais facilement avec Kanboard, la solution de gestion de projet visuelle et intuitive.
                </p>
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-block px-8 py-3 bg-dark text-white text-lg font-important rounded-md shadow-md hover:bg-secondaire transition">
                        Commencer maintenant
                    </a>
                @endguest
            </div>
        </section>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
