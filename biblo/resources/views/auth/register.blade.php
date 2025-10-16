@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label>Prénom</label>
        <input type="text" name="first_name" required class="border p-2 w-full">
    </div>
    <div>
        <label>Nom</label>
        <input type="text" name="last_name" required class="border p-2 w-full">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" required class="border p-2 w-full">
    </div>
    <div>
        <label>Filière</label>
        <input type="text" name="filiere" class="border p-2 w-full">
    </div>
    <div>
        <label>Niveau d'étude</label>
        <input type="text" name="niveau_etude" required class="border p-2 w-full">
    </div>
    <div>
        <label>Université</label>
        <input type="text" name="universite" class="border p-2 w-full">
    </div>
    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" required class="border p-2 w-full">
    </div>
    <button type="submit" class="bg-blue-500 text-white p-2">S'inscrire</button>
</form>
@endsection