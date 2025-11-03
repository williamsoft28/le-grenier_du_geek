{{-- resources/views/forum/category.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    {{-- Fil d’Ariane --}}
    <nav class="text-sm mb-4" aria-label="Breadcrumb">
        <ol class="list-reset flex text-gray-600">
            <li><a href="{{ route('forum.index') }}" class="hover:underline">Forum</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="font-semibold text-gray-800">{{ $category->title ?? 'Catégorie' }}</li>
        </ol>
    </nav>

    {{-- Titre et description de la catégorie --}}
    <h1 class="text-3xl font-bold mb-2">{{ $category->title ?? 'Catégorie' }}</h1>
    @if(!empty($category->description))
        <p class="text-gray-600 mb-4">{{ $category->description }}</p>
    @endif

    {{-- Stats de la catégorie --}}
    <div class="text-sm text-gray-500 mb-6">
        {{ $threads->total() ?? 0 }} discussion(s)
        • {{ $threads->sum(fn($t) => $t->posts_count ?? $t->posts->count()) ?? 0 }} réponse(s)
    </div>

    {{-- Liste des discussions --}}
    <h2 class="text-xl font-semibold mb-3">Discussions</h2>

    @if(isset($threads) && $threads->isNotEmpty())
        <ul class="space-y-3">
            @foreach($threads as $thread)
                @php
                    $threadSlug = $thread->slug ?? \Illuminate\Support\Str::slug($thread->title ?? 'thread');
                    $lastPost = $thread->posts->last() ?? null;
                @endphp
                <li class="border p-3 rounded bg-white shadow-sm">
                    <a href="{{ route('forum.thread.show', [
                        'thread' => $thread->id,
                        'thread_slug' => $threadSlug
                    ]) }}" class="text-blue-600 hover:underline font-medium">
                        {{ $thread->title ?? 'Sujet sans titre' }}
                    </a>

                    @if($lastPost)
                        <p class="text-sm text-gray-500 mt-1">
                            {{ \Illuminate\Support\Str::limit($lastPost->body, 150) }}
                        </p>
                    @endif

                    <div class="text-xs text-gray-400 mt-1 flex flex-wrap gap-2">
                        <span>Créé par {{ $thread->author->name ?? 'Utilisateur' }}</span>
                        <span>• {{ $thread->created_at->diffForHumans() }}</span>
                        <span>• {{ $thread->posts_count ?? $thread->posts->count() }} réponse(s)</span>
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $threads->links() }}
        </div>

    @else
        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded">
            <p class="text-gray-700">Aucune discussion pour le moment. Sois le premier à lancer une conversation !</p>
        </div>
    @endif

    {{-- Bouton pour créer une nouvelle discussion --}}
    @auth
        <a href="{{ route('forum.thread.create', ['category_id' => $category->id, 'category_slug' => $category->slug]) }}" 
           class="inline-block mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Démarrer une discussion
        </a>
    @endauth

</div>
@endsection
