@extends('layouts.app')

@section('content')
<!-- IMPORTANT: Ce template utilise Tailwind CSS (v3+) et un petit script vanilla pour l'accessibilité.
     Optionnel: tu peux remplacer les icônes SVG par heroicons ou lucide si tu veux.
-->

<div class="min-h-screen bg-gradient-to-b from-slate-50 to-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header / Hero -->
    <header class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
      <div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">Explorer les catégories</h1>
        <p class="mt-3 text-lg text-slate-600 max-w-2xl">Choisis un domaine et découvre des ressources, tutoriels et documents partagés par la communauté.</p>
      </div>

      <div class="w-full md:w-auto flex items-center gap-3">
        <!-- Search -->
        <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2 w-full md:w-80">
          <label for="q" class="sr-only">Rechercher</label>
          <div class="relative w-full">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35"></path><circle cx="11" cy="11" r="6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle></svg>
            <input id="q" name="q" value="{{ request('q') }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Rechercher titre, auteur, module...">
          </div>
        </form>

        <!-- Explore modal trigger -->
        <button onclick="openExplore()" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow"> 
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
          Explorer
        </button>
      </div>
    </header>

    <!-- Filters / Stats bar -->
    <div class="mt-8 flex items-center justify-between gap-4">
      <div class="flex items-center gap-3 text-sm text-slate-600">
        <span class="font-medium text-slate-800">{{ $books->total() }} documents</span>
        <span>&middot;</span>
        <span>{{ $books->count() }} affichés</span>
      </div>

      <div class="flex items-center gap-3">
        <a href="/books?sort=new" class="px-3 py-1 rounded-md text-sm bg-slate-100 hover:bg-slate-200">Plus récents</a>
        <a href="/books?sort=popular" class="px-3 py-1 rounded-md text-sm bg-slate-100 hover:bg-slate-200">Populaires</a>
      </div>
    </div>

    <!-- Grid des cartes -->
    <main class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($books as $book)
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transform hover:-translate-y-1 transition p-5 flex flex-col">
          <div class="flex items-start gap-4">
            <!-- Miniature / placeholder -- replace with real cover if available -->
            <div class="flex-shrink-0 w-20 h-28 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-md overflow-hidden flex items-center justify-center">
              <span class="text-xs font-semibold text-indigo-700">{{ strtoupper(substr($book->module ?? 'DOC', 0, 3)) }}</span>
            </div>

            <div class="flex-1">
              <h3 class="text-lg font-semibold text-slate-900">{{ $book->title }}</h3>
              <p class="mt-1 text-sm text-slate-500">Par <span class="font-medium text-slate-700">{{ $book->author }}</span> · {{ $book->niveau_etude }} · <span class="inline-block px-2 py-0.5 rounded-full text-xs bg-slate-100">{{ $book->module }}</span></p>

              <p class="mt-3 text-slate-700 text-sm leading-relaxed">{{ Str::limit($book->description, 140) }}</p>

              <div class="mt-4 flex items-center gap-2">
                <a href="{{ route('books.show', $book) }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700">Voir</a>

                @auth
                  <a href="{{ Storage::url($book->file_path) }}" download class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-indigo-200 bg-white text-indigo-700 hover:bg-indigo-50">Télécharger</a>
                @else
                  <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-slate-200 bg-white text-slate-800 hover:bg-slate-50">Créer un compte</a>
                @endauth

                @if($book->tutoriel)
                  <span class="ml-auto text-xs inline-flex items-center gap-2 px-2 py-1 rounded-full bg-emerald-50 text-emerald-700">📘 Tutoriel</span>
                @endif
              </div>
            </div>
          </div>
        </article>
      @empty
        <div class="col-span-full bg-white rounded-lg p-8 text-center shadow">
          <h3 class="text-2xl font-semibold">Aucun document</h3>
          <p class="mt-2 text-slate-600">Soyez le premier à contribuer.</p>
          @auth
            <a href="/books/create" class="mt-4 inline-block px-6 py-3 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700">+ Ajouter un document</a>
          @else
            <a href="{{ route('register') }}" class="mt-4 inline-block px-6 py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">Créer un compte</a>
          @endauth
        </div>
      @endforelse
    </main>

    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-center">
      {{ $books->appends(request()->query())->links() }}
    </div>

  </div>
</div>

<!-- Overlay / Modal d'exploration (accessible) -->
<div id="overlay" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="overlay-title">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeExplore()"></div>
  <div class="fixed inset-0 flex items-center justify-center p-6">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden">
      <div class="p-6 border-b flex items-center justify-between">
        <h2 id="overlay-title" class="text-xl font-semibold">Catégories Informatique</h2>
        <div class="flex items-center gap-3">
          <button onclick="closeExplore()" aria-label="Fermer" class="rounded-md p-2 hover:bg-slate-100">
            <svg class="h-6 w-6 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
      </div>

      <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="/books?cat=ia" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-indigo-800 group-hover:text-indigo-900">IA & Machine Learning</h3>
          <p class="text-sm text-slate-500 mt-1">Algorithmes, Deep Learning, NLP</p>
        </a>
        <a href="/books?cat=web" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-purple-800 group-hover:text-purple-900">Développement Web</h3>
          <p class="text-sm text-slate-500 mt-1">HTML, JavaScript, Frameworks</p>
        </a>
        <a href="/books?cat=bd" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-green-800 group-hover:text-green-900">Bases de données</h3>
          <p class="text-sm text-slate-500 mt-1">SQL, NoSQL, Modélisation</p>
        </a>
        <a href="/books?cat=securite" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-red-800 group-hover:text-red-900">Sécurité</h3>
          <p class="text-sm text-slate-500 mt-1">Cryptographie, Réseau, Audit</p>
        </a>
        <a href="/books?cat=prog" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-yellow-800 group-hover:text-yellow-900">Programmation</h3>
          <p class="text-sm text-slate-500 mt-1">Python, Java, Rust</p>
        </a>
        <a href="/books" class="group p-4 border rounded-lg hover:shadow transition flex flex-col">
          <h3 class="font-semibold text-slate-800 group-hover:text-slate-900">Tous les domaines</h3>
          <p class="text-sm text-slate-500 mt-1">Recherche globale</p>
        </a>
      </div>

    </div>
  </div>
</div>

<script>
// Simple accessible show/hide for the modal
function openExplore(){
  const el = document.getElementById('overlay');
  el.classList.remove('hidden');
  // focus trap simple approach
  const focusable = el.querySelector('a, button, input');
  if(focusable) focusable.focus();
}
function closeExplore(){
  const el = document.getElementById('overlay');
  el.classList.add('hidden');
}

// Close modal on ESC
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){
    const el = document.getElementById('overlay');
    if(!el.classList.contains('hidden')) closeExplore();
  }
});
</script>

@endsection
