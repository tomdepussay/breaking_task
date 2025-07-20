<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6 text-center space-y-4">
        <div class="flex items-center gap-2 text-2xl font-title text-dark">
            <x-application-logo class="w-8 h-8" />
            <span class="font-semibold tracking-wide">Breaking Task</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-800">Vérification de votre adresse email 📧</h2>

        <p class="text-gray-600">
            Merci pour votre inscription ! <br>
            Avant de commencer, merci de vérifier votre adresse email en cliquant sur le lien
            que nous vous avons envoyé.
        </p>

        <p class="text-sm text-red-500">
            Une fois que vous avez confirmé votre email, vous pouvez fermer cette page ou revenir sur l’application.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="text-green-600 text-sm">
                📬 Un nouveau lien de vérification vient d’être envoyé à votre adresse email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded shadow">
                Renvoyer l’email de vérification
            </button>
        </form>

        <a href="{{ route('logout') }}" class="inline-block text-sm text-gray-500 hover:underline mt-2">
            Se déconnecter
        </a>
    </div>
</x-guest-layout>
