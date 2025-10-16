@extends('layouts.guest')

@section('content')
<h2 class="text-xl font-bold mb-4 text-center">Debug : Formulaire de Connexion</h2>  <!-- Debug temporaire – supprime après -->

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Mot de passe')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('Se connecter') }}
        </x-primary-button>
    </div>
</form>

<p class="mt-4 text-sm text-gray-600 text-center">Debug : Si tu vois ça, le contenu s'injecte bien !</p>  <!-- Debug – supprime après -->
@endsection