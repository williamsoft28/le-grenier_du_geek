@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Catalogue de Livres</h1>
<form method="GET" class="mb-4">
    <input type="text" name="q" placeholder="Rechercher par titre, auteur, niveau ou module..." class="border p-2 rounded" value="{{ request('q') }}">
    <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2">Chercher</button>
    <a href="{{ route('books.create') }}" class="bg-green-500 text-white p-2 rounded ml-2">Soumettre Document</a>
</form>
@if($books->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($books as $book)
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">{{ $book->title }}</h2>
            <p class="text-sm text-gray-600">Auteur: {{ $book->author }}</p>
            <p class="text-sm">Niveau: {{ $book->niveau_etude }} | Module: {{ $book->module }}</p>
            <p>{{ Str::limit($book->description, 100) }}</p>
            @if($book->tutoriel)
                <p class="text-xs text-blue-600">Tutoriel disponible</p>
            @endif
            <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:underline">Voir/Télécharger</a>
        </div>
        @endforeach
    </div>
    {{ $books->links() }}
@else
    <p>Aucun livre pour l'instant. <a href="{{ route('books.create') }}" class="text-blue-500">Soumettez le premier !</a></p>
@endif
@endsection