<nav class="bg-blue-600 text-white p-4">
    <a href="/books" class="mr-4">Livres</a>
    @auth
        <a href="/forum" class="mr-4">Forum</a>
        <a href="/chat" class="mr-4">Chat</a>
        <span>Bonjour, {{ auth()->user()->full_name }}</span>
        <a href="/logout" class="ml-4">Déconnexion</a>
    @else
        <a href="/login" class="mr-4">Connexion</a>
        <a href="/register">S'inscrire</a>
    @endauth
    @guest
        <a href="/books/create" class="ml-4 bg-green-500 px-2 py-1 rounded">Soumettre Document</a>
    @endguest
</nav>