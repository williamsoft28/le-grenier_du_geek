@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">{{ $category->title }}</h1>
    <p class="text-gray-600 mb-8">{{ $category->description }}</p>

    @auth
        <a href="{{ route('forum.thread.create', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block hover:bg-blue-600">+ Nouvelle Discussion</a>
    @endauth

    @forelse($category->threads as $thread)
        <div class="bg-white p-6 rounded-lg shadow mb-4">
            <h3 class="text-lg font-semibold"><a href="{{ route('forum.thread.show', $thread) }}" class="text-blue-600 hover:underline">{{ $thread->title }}</a></h3>
            <p class="text-sm text-gray-600">Par {{ $thread->author->full_name }} · {{ $thread->posts->count() }} réponses · {{ $thread->created_at->diffForHumans() }}</p>
            @if($thread->posts->last())
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($thread->posts->last()->body, 100) }}</p>
            @endif
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">Aucune discussion dans cette catégorie. Soyez le premier !</p>
    @endforelse

    {{ $category->threads->links() }}
</div>
@endsection