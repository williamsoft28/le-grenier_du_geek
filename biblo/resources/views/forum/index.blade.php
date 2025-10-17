@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-100 to-gray-200 py-16 px-4">
    <div class="max-w-5xl mx-auto text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Forum du Grenier du Geek</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Rejoignez la communauté, échangez sur le développement, la sécurité, les réseaux et bien plus encore.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($categories as $category)
            <a href="{{ route('forum.category.show', $category->slug) }}" 
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $category->name }}</h2>
                <p class="text-gray-500 text-sm">Voir les discussions →</p>
            </a>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">Aucune catégorie disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
