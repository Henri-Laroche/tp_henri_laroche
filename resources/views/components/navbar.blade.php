<nav class="bg-blue-500 p-4">
    <div class="flex justify-between items-center">
        <a href="/" class="text-white text-xl">Test Laroche Henri</a>
        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="text-white">Home</a></li>

            {{-- Afficher uniquement si l'utilisateur est invité (non connecté) --}}
            @guest
                <li><a href="{{ route('login') }}" class="text-white">Connecter</a></li>
                <li><a href="{{ route('register') }}" class="text-white">Créer un compte</a></li>
            @endguest

            {{-- Afficher uniquement si l'utilisateur est authentifié (connecté) --}}
            @auth
                <li><a href="{{ route('dashboard') }}" class="text-white">Dashboard</a></li>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Se déconnecter</button>
                </form>
            @endauth
        </ul>
    </div>
</nav>
