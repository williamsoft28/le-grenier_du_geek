@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6">
  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <h1 class="text-2xl font-bold mb-2">{{ $thread->title }}</h1>
    <p class="text-sm text-slate-500 mb-4">Par {{ $thread->user->name }} · {{ $thread->created_at->diffForHumans() }}</p>
    <div class="prose max-w-none text-slate-700 mb-4">
      {!! nl2br(e($thread->posts->first()->body)) !!}
    </div>
  </div>

  <section class="space-y-4">
    @foreach($thread->posts()->skip(1)->get() as $post) {{-- skip first if it's original --}}
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-start gap-4">
          <div class="flex-1">
            <p class="text-sm text-slate-600">{{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}</p>
            <div class="mt-2 text-slate-700">{!! nl2br(e($post->body)) !!}</div>
          </div>
        </div>
      </div>
    @endforeach
  </section>

  @auth
  <div class="mt-6 bg-white p-4 rounded-lg shadow">
    <form action="{{ route('posts.store', $thread) }}" method="POST">
      @csrf
      <textarea name="body" rows="4" class="w-full rounded border p-2" placeholder="Écrire une réponse..." required></textarea>
      <div class="mt-2 text-right">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Répondre</button>
      </div>
    </form>
  </div>
  @else
    <p class="mt-6 text-center text-slate-600">Veuillez <a href="{{ route('login') }}" class="text-indigo-600">vous connecter</a> pour répondre.</p>
  @endauth
</div>
@endsection
