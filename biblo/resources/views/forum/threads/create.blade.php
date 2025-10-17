@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Créer un nouveau sujet</h2>

    <form action="{{ route('threads.store') }}" method="POST">
        @csrf

        <!-- Titre -->
        <div class="mb-4">
            <label class="block font-semibold mb-2" for="title">Titre</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2"
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Catégorie -->
        <div class="mb-4">
            <label class="block font-semibold mb-2" for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contenu -->
        <div class="mb-4">
            <label class="block font-semibold mb-2" for="content">Contenu</label>
            <textarea name="content" id="content" rows="6" class="w-full border border-gray-300 rounded px-3 py-2"
                      required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">
                Publier le sujet
            </button>
        </div>
    </form>
</div>
@endsection
