@extends('layouts.app')

@section('content')
<h1>Soumettre un Document</h1>
<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Champs user pré-remplis et verrouillés -->
    <div>
        <label>Prénom</label>
        <input type="text" value="{{ auth()->user()->first_name }}" disabled class="border p-2 w-full bg-gray-200">
    </div>
    <div>
        <label>Nom</label>
        <input type="text" value="{{ auth()->user()->last_name }}" disabled class="border p-2 w-full bg-gray-200">
    </div>
    <div>
        <label>Email</label>
        <input type="email" value="{{ auth()->user()->email }}" disabled class="border p-2 w-full bg-gray-200">
    </div>
    <!-- Autres champs comme ci-dessus : title, etc. -->
    <div>
        <label>Niveau d'étude</label>
        <input type="text" name="niveau_etude" class="border p-2 w-full" value="{{ auth()->user()->niveau_etude }}">
    </div>
    <!-- ... (ajoute author, file, module, tutoriel comme dans create-guest) -->
    <button type="submit">Soumettre</button>
</form>
@endsection