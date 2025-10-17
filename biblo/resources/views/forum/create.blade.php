@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">Créer une nouvelle discussion</h2>
 <form action="{{ route('forum.thread.store') }}" method="POST">
    @csrf
    <label for="title">Titre :</label>
    <input type="text" name="title" required>

    <label for="category">Catégorie :</label>
    <select name="category_slug" required>
        @foreach($categories as $category)
            <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label for="content">Message :</label>
    <textarea name="content" required></textarea>

    <button type="submit">Créer le sujet</button>
</form>

</div>
@endsection
