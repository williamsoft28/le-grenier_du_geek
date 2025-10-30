@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $thread->title }}</h1>
    <p class="text-sm text-gray-600 mb-4">Dans {{ $thread->category->title }} · Par {{ $thread->author->full_name }} · {{ $thread->created_at->diffForHumans() }}</p>

    @forelse($thread->posts as $post)
        <div class="bg-white p-6 rounded-lg shadow mb-4">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <img src="{{ $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->full_name) }}" alt="{{ $post->author->full_name }}" class="w-10 h-10 rounded-full">
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold">{{ $post->author->full_name }}</h4>
                    <p class="text-sm text-gray-700 mt-2">{{ $post->body }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    @empty
        <p>Aucun post pour l'instant.</p>
    @endforelse

    @auth
        <form method="POST" action="{{ route('forum.thread.reply', $thread) }}" class="mt-6 p-4 bg-gray-50 rounded-lg">
            @csrf
            <label class="block text-sm font-medium mb-2">Votre Réponse</label>
            <textarea name="body" required rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Partagez votre réponse..."></textarea>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Répondre</button>
        </form>
    @else
        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
            <p class="text-yellow-800">Connectez-vous pour répondre.</p>
            <a href="{{ route('login') }}" class="text-yellow-600 hover:underline">Se Connecter</a>
        </div>
    @endauth
</div>
@endsection