@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Soumettre un Document</h1>
<p class="mb-4 text-gray-600">Vos infos sont pré-remplies (non modifiables).</p>

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- Champs User Verrouillés -->
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Prénom</label>
            <input type="text" value="{{ auth()->user()->first_name }}" disabled class="block w-full border p-2 rounded bg-gray-100">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" value="{{ auth()->user()->last_name }}" disabled class="block w-full border p-2 rounded bg-gray-100">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" disabled class="block w-full border p-2 rounded bg-gray-100">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Filière</label>
            <input type="text" value="{{ auth()->user()->filiere }}" class="block w-full border p-2 rounded" name="filiere">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Université</label>
            <input type="text" value="{{ auth()->user()->universite }}" class="block w-full border p-2 rounded" name="universite">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Niveau d'Étude <span class="text-red-500">*</span></label>
            <input type="text" name="niveau_etude" required class="block w-full border p-2 rounded" value="{{ old('niveau_etude') }}" placeholder="Ex: Licence 3">
            <x-input-error :messages="$errors->get('niveau_etude')" class="mt-1" />
        </div>
    </div>

    <!-- Champs Document -->
    <h2 class="text-lg font-semibold mb-2">Infos du Document</h2>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Titre <span class="text-red-500">*</span></label>
        <input type="text" name="title" required class="block w-full border p-2 rounded" value="{{ old('title') }}">
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Auteur <span class="text-red-500">*</span></label>
        <input type="text" name="author" required class="block w-full border p-2 rounded" value="{{ old('author') }}">
        <x-input-error :messages="$errors->get('author')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
        <textarea name="description" required class="block w-full border p-2 rounded" rows="3">{{ old('description') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Module (pour recherche) <span class="text-red-500">*</span></label>
        <select name="module" required class="block w-full border p-2 rounded">
            <option value="">Sélectionnez un domaine</option>
            <option value="ia" {{ old('module') == 'ia' ? 'selected' : '' }}>IA & Machine Learning (Algorithmes, Deep Learning, NLP)</option>
            <option value="web" {{ old('module') == 'web' ? 'selected' : '' }}>Développement Web (HTML, JS, Frameworks)</option>
            <option value="bd" {{ old('module') == 'bd' ? 'selected' : '' }}>Bases de Données (SQL, NoSQL, Modélisation)</option>
            <option value="securite" {{ old('module') == 'securite' ? 'selected' : '' }}>Sécurité Informatique (Cryptographie, Réseau, Audit)</option>
            <option value="prog" {{ old('module') == 'prog' ? 'selected' : '' }}>Programmation (Python, Java, Rust)</option>
        </select>
        <x-input-error :messages="$errors->get('module')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Tutoriel (texte optionnel)</label>
        <textarea name="tutoriel" class="block w-full border p-2 rounded" rows="3">{{ old('tutoriel') }}</textarea>
        <x-input-error :messages="$errors->get('tutoriel')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Fichier (PDF/ePub) <span class="text-red-500">*</span></label>
        <input type="file" name="file" required class="block w-full border p-2 rounded" accept=".pdf,.epub">
        <x-input-error :messages="$errors->get('file')" class="mt-1" />
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Soumettre</button>
</form>

@endsection