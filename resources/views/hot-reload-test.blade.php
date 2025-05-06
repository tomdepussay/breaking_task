<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hot Reload Test avec Tailwind</title>
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-100 to-blue-100 flex flex-col items-center justify-center text-gray-800">

    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-6">
            ✅ Tailwind fonctionne !
        </h1>

        <p class="text-lg text-center mb-4">
            Modifie ce texte ou la couleur ci-dessous pour tester le hot reload.
        </p>

        <button id="reload-btn" class="w-full px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-lg transition">
            Cliquer ici
        </button>
    </div>

</body>
</html>
