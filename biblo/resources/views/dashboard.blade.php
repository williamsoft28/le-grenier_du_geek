@extends('layouts.app')

@section('content')
<div class="py-12 text-center">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Le Grenier du Geek</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
        Découvrez des ressources numériques dédiées aux étudiants en informatique : cours, tutoriels, documents par domaine. Partagez et apprenez ensemble dans une communauté sécurisée.
    </p>
    <a href="/explore" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-lg text-xl font-semibold shadow-lg transition-all duration-300 inline-block">
        🔍 Explorer les Ressources
    </a>
</div>
@endsection