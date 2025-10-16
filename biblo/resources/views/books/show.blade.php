@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
<p class="text-lg mb-2">Auteur: {{ $book->author }}</p>
<p class="mb-2">Niveau: {{ $book->niveau_etude }} | Module: {{ $book->module }}</p>
<p class="mb-4">{{ $book->description }}</p>
@if($book->tutoriel)
    <div class="bg-yellow-100 p-4 rounded mb-4">
        <h3 class="font-semibold">Tutoriel :</h3>
        <p>{{ $book->tutoriel }}</p>
    </div>
@endif
<iframe src="{{ Storage::url($book->file_path) }}" class="w-full h-96 border rounded mb-4" title="Aperçu"></iframe>
<a href="{{ Storage::url($book->file_path) }}" download class="bg-blue-500 text-white px-4 py-2 rounded">Télécharger</a>
<a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Retour</a>
@endsection