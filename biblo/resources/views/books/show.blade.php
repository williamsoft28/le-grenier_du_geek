@extends('layouts.app')

@section('content')
<h1>{{ $book->title }}</h1>
<p>Auteur: {{ $book->author }}</p>
<p>Description: {{ $book->description }}</p>
@if($book->tutoriel)
    <div class="bg-yellow-100 p-4 mt-4">
        <h3>Tutoriel:</h3>
        <p>{{ $book->tutoriel }}</p>
    </div>
@endif
<iframe src="{{ Storage::url($book->file_path) }}" class="w-full h-96 mt-4"></iframe>  <!-- Aperçu PDF -->
<a href="{{ Storage::url($book->file_path) }}" download class="bg-blue-500 text-white p-2 mt-4 inline-block">Télécharger</a>
@endsection