@extends('layouts.app')

@section('content')
<h1>Catalogue (Accès libre pour voir/télécharger)</h1>
<form method="GET" class="mb-4">
    <input type="text" name="q" placeholder="Rechercher par titre, auteur, niveau ou module..." class="border p-2" value="{{ request('q') }}">
    <button type="submit" class="bg-blue-500 text-white p-2">Chercher</button>
    @guest
        <a href="{{ route('books.create') }}" class="bg-green-500 text-white p-2 ml-2">Soumettre (Créez un compte)</a>
    @else
        <a href="{{ route('books.create') }}" class="bg-green-500 text-white p-2 ml-2">Soumettre</a>
    @endguest
</form>
<div class="grid grid-cols-3 gap-4">
    @foreach($books as $book)
    <div class="bg-white p-4 rounded shadow">
        <h2>{{ $book->title }}</h2>
        <p>Auteur: {{ $book->author }} | Niveau: {{ $book->niveau_etude }} | Module: {{ $book->module }}</p>
        <p>{{ Str::limit($book->description, 100) }}</p>
        @if($book->tutoriel)
            <p><strong>Tutoriel:</strong> {{ Str::limit($book->tutoriel, 50) }}</p>
        @endif
        <a href="{{ route('books.show', $book) }}" class="text-blue-500">Voir/Télécharger</a>
    </div>
    @endforeach
</div>
{{ $books->links() }}
@endsection