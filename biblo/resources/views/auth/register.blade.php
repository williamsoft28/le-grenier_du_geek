@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Prénom -->
    <div>
        <x-input-label for="first_name" :value="__('Prénom')" />
        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
    </div>

    <!-- Nom -->
    <div class="mt-4">
        <x-input-label for="last_name" :value="__('Nom')" />
        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Filière -->
    <div class="mt-4">
        <x-input-label for="filiere" :value="__('Filière')" />
        <x-text-input id="filiere" class="block mt-1 w-full" type="text" name="filiere" :value="old('filiere')" autocomplete="filiere" />
        <x-input-error :messages="$errors->get('filiere')" class="mt-2" />
    </div>

    <!-- Niveau d'Étude -->
    <div class="mt-4">
        <x-input-label for="niveau_etude" :value="__('Niveau d\'étude')" />
        <x-text-input id="niveau_etude" class="block mt-1 w-full" type="text" name="niveau_etude" :value="old('niveau_etude')" required autocomplete="niveau-etude" />
        <x-input-error :messages="$errors->get('niveau_etude')" class="mt-2" />
    </div>

    <!-- Université -->
    <div class="mt-4">
        <x-input-label for="universite" :value="__('Université')" />
        <x-text-input id="universite" class="block mt-1 w-full" type="text" name="universite" :value="old('universite')" autocomplete="universite" />
        <x-input-error :messages="$errors->get('universite')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Mot de passe')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('S\'inscrire') }}
        </x-primary-button>
    </div>
</form>
@endsection