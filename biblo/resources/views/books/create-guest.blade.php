@extends('layouts.app')

@section('content')
<h1>Soumettre un Document (Création de compte auto)</h1>
<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="guest" value="true">
    <div>
        <label>Prénom <span class="text-red-500">*</span></label>
        <input type="text" name="first_name" id="first_name" required class="border p-2 w-full" value="{{ session('guest_first_name', old('first_name')) }}" 
               oninput="lockFields(this.value, 'first_name')">
    </div>
    <div>
        <label>Nom <span class="text-red-500">*</span></label>
        <input type="text" name="last_name" id="last_name" required class="border p-2 w-full" value="{{ session('guest_last_name', old('last_name')) }}" 
               oninput="lockFields(this.value, 'last_name')">
    </div>
    <div>
        <label>Email <span class="text-red-500">*</span></label>
        <input type="email" name="email" id="email" required class="border p-2 w-full" value="{{ session('guest_email', old('email')) }}" 
               oninput="lockFields(this.value, 'email')">
    </div>
    <div>
        <label>Filière</label>
        <input type="text" name="filiere" class="border p-2 w-full" value="{{ old('filiere') }}">
    </div>
    <div>
        <label>Université</label>
        <input type="text" name="universite" class="border p-2 w-full" value="{{ old('universite') }}">
    </div>
    <div>
        <label>Niveau d'étude <span class="text-red-500">*</span></label>
        <input type="text" name="niveau_etude" required class="border p-2 w-full" value="{{ old('niveau_etude') }}">
    </div>
    <h2>Infos Document</h2>
    <div>
        <label>Titre</label>
        <input type="text" name="title" required class="border p-2 w-full">
    </div>
    <div>
        <label>Auteur</label>
        <input type="text" name="author" required class="border p-2 w-full">
    </div>
    <div>
        <label>Description</label>
        <textarea name="description" required class="border p-2 w-full"></textarea>
    </div>
    <div>
        <label>Module (pour recherche)</label>
        <input type="text" name="module" class="border p-2 w-full">
    </div>
    <div>
        <label>Tutoriel (texte optionnel)</label>
        <textarea name="tutoriel" class="border p-2 w-full"></textarea>
    </div>
    <div>
        <label>Fichier (PDF/ePub)</label>
        <input type="file" name="file" required class="border p-2 w-full">
    </div>
    <button type="submit" class="bg-green-500 text-white p-2">Soumettre</button>
</form>

<script>
function lockFields(value, field) {
    if (value) {
        // Simule verrouillage : disabled après saisie (mais submit possible)
        document.getElementById(field).disabled = true;
        // Stocke en session via AJAX si besoin, mais pour simplicité, value persiste
    }
}
</script>
@endsection