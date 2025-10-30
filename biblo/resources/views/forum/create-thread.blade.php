@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Nouvelle Discussion</h1>

    <form method="POST" action="{{ route('forum.thread.store') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-2">Catégorie <span class="text-red-500">*</span></label>
            <select name="category_id" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionnez une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }} ({{ $category->threads_count }} discussions)
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Titre <span class="text-red-500">*</span></label>
            <input type="text" name="title" required value="{{ old('title') }}" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Ex: 'Comment implémenter un algorithme de ML ?'">
            <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Contenu <span class="text-red-500">*</span></label>
            <textarea name="body" required rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Posez votre question ou partagez votre expérience...">{{ old('body') }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-1" />
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-600">Publier Discussion</button>
            <a href="{{ route('forum.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-600">Annuler</a>
        </div>
    </form>
</div>
@endsection