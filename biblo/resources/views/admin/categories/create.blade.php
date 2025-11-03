@extends('layouts.app')

@section('content')
    <h1>Créer une nouvelle catégorie</h1>
    
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="slug">Slug :</label>
            <input type="text" name="slug" id="slug" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit">Créer la catégorie</button>
    </form>
@endsection
