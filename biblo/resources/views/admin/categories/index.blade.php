@extends('layouts.app')

@section('content')
    <h1>Liste des catégories</h1>
    
    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.categories.create') }}">Créer une nouvelle catégorie</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Slug</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->title }}</td>
                <td>{{ $cat->slug }}</td>
                <td>{{ $cat->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
