@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Soumettre un Document (Création de Compte Auto)</h1>
<p class="mb-4 text-gray-600">Remplissez vos infos (verrouillées après saisie pour sécurité). Vous serez connecté auto.</p>

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="guest" value="true">

    <!-- Champs User (pré-remplis et verrouillés) -->
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Prénom <span class="text-red-500">*</span></label>
            <input type="text" name="first_name" id="first_name" required class="block w-full border p-2 rounded" 
                   value="{{ $guestData['first_name'] ?? old('first_name') }}" 
                   onblur="lockField('first_name')" placeholder="Votre prénom">
            <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Nom <span class="text-red-500">*</span></label>
            <input type="text" name="last_name" id="last_name" required class="block w-full border p-2 rounded" 
                   value="{{ $guestData['last_name'] ?? old('last_name') }}" 
                   onblur="lockField('last_name')" placeholder="Votre nom">
            <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" required class="block w-full border p-2 rounded" 
                   value="{{ $guestData['email'] ?? old('email') }}" 
                   onblur="lockField('email')" placeholder="votre@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Filière</label>
            <input type="text" name="filiere" class="block w-full border p-2 rounded" 
                   value="{{ $guestData['filiere'] ?? old('filiere') }}" placeholder="Ex: Informatique">
            <x-input-error :messages="$errors->get('filiere')" class="mt-1" />
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Université</label>
            <input type="text" name="universite" class="block w-full border p-2 rounded" 
                   value="{{ $guestData['universite'] ?? old('universite') }}" placeholder="Ex: Univ Paris">
            <x-input-error :messages="$errors->get('universite')" class="mt-1" />
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Niveau d'Étude <span class="text-red-500">*</span></label>
            <input type="text" name="niveau_etude" required class="block w-full border p-2 rounded" 
                   value="{{ old('niveau_etude') }}" placeholder="Ex: Licence 3">
            <x-input-error :messages="$errors->get('niveau_etude')" class="mt-1" />
        </div>
    </div>

    <!-- Champs Document -->
    <h2 class="text-lg font-semibold mb-2">Infos du Document</h2>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Titre <span class="text-red-500">*</span></label>
        <input type="text" name="title" required class="block w-full border p-2 rounded" value="{{ old('title') }}" placeholder="Titre du document">
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Auteur <span class="text-red-500">*</span></label>
        <input type="text" name="author" required class="block w-full border p-2 rounded" value="{{ old('author') }}" placeholder="Auteur">
        <x-input-error :messages="$errors->get('author')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Description <span class="text-red-500">*</span></label>
        <textarea name="description" required class="block w-full border p-2 rounded" rows="3" placeholder="Brève description">{{ old('description') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Module (pour recherche)</label>
        <input type="text" name="module" class="block w-full border p-2 rounded" value="{{ old('module') }}" placeholder="Ex: Algo 101">
        <x-input-error :messages="$errors->get('module')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Tutoriel (texte optionnel)</label>
        <textarea name="tutoriel" class="block w-full border p-2 rounded" rows="3" placeholder="Instructions d'utilisation">{{ old('tutoriel') }}</textarea>
        <x-input-error :messages="$errors->get('tutoriel')" class="mt-1" />
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Fichier (PDF/ePub) <span class="text-red-500">*</span></label>
        <input type="file" name="file" required class="block w-full border p-2 rounded" accept=".pdf,.epub">
        <x-input-error :messages="$errors->get('file')" class="mt-1" />
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Soumettre Document</button>
</form>

<script>
function lockField(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.value.trim() !== '') {
        field.disabled = true;  // Verrouille après saisie
        field.style.backgroundColor = '#f3f4f6';  // Gris pour visuel
        field.title = 'Verrouillé – non modifiable';
    }
}
</script>

@endsection