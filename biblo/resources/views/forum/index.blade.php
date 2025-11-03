@extends('layouts.app')

@section('content')
<div class="py-8 max-w-6xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Forum du Grenier du Geek</h1>
        <p class="text-lg text-gray-600">Échangez sur vos domaines préférés : IA, web, BD, sécurité et programmation. Démarrez une discussion dans une catégorie !</p>
    </div>

    @auth
        <div class="mb-8 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
            <h2 class="font-semibold text-blue-800 mb-2">Prêt à discuter ?</h2>
            <p class="text-blue-700">Choisissez une catégorie pour démarrer une nouvelle discussion.</p>
        </div>
    @else
        <div class="mb-8 p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
            <h2 class="font-semibold text-yellow-800 mb-2">Connectez-vous pour Poster</h2>
            <p class="text-yellow-700">Créez un compte pour démarrer des discussions et interagir.</p>
            <a href="{{ route('register') }}" class="mt-2 inline-block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">S'inscrire</a>
        </div>
    @endauth

    <!-- Grille des Catégories -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-semibold mb-2">{{ $category->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($category->description, 100) }}</p>
                <p class="text-sm text-gray-500 mb-4">{{ $category->threads_count }} discussions · {{ $category->posts_count }} posts</p>

                @auth
                    <a href="{{ route('forum.thread.create', [
                        'category_id'   => $category->id,
                        'category_slug' => $category->slug ?? \Illuminate\Support\Str::slug($category->title)
                    ]) }}" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm font-medium">
                        Démarrer Discussion
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-sm font-medium">
                        Se Connecter pour Poster
                    </a>
                @endauth

                <a href="{{ route('forum.category.show', [
                    'category_id'   => $category->id,
                    'category_slug' => $category->slug ?? \Illuminate\Support\Str::slug($category->title)
                ]) }}" class="block mt-3 text-blue-600 hover:underline text-sm">
                    Voir les Discussions
                </a>
            </div>
        @endforeach
    </div>

    @if($categories->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucune catégorie disponible pour le moment.</p>
            @auth
                <a href="/admin/categories/create" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Créer la Première
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
