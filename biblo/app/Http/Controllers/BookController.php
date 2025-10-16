<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);  // Anonyme pour voir/télécharger
    }

    public function index(Request $request)
    {
        $books = Book::search($request->q ?? '')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));  // Pour lire/télécharger anonyme
    }

    public function create()
    {
        if (!Auth::check()) {
            // Si pas connecté, redirige vers formulaire étendu
            return view('books.create-guest');
        }
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf,epub',
            'niveau_etude' => 'nullable|string',
            'module' => 'nullable|string',
            'tutoriel' => 'nullable|text',
            // Champs user si guest
            'first_name' => 'required_if:guest,true|string',
            'last_name' => 'required_if:guest,true|string',
            'email' => 'required_if:guest,true|email|unique:users',
        ]);

        $user = Auth::user();
        if ($request->has('guest')) {
            // Créer user guest
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'filiere' => $request->filiere ?? null,
                'niveau_etude' => $request->niveau_etude,
                'universite' => $request->universite ?? null,
            ];
            $user = User::createGuest($userData);
            Auth::login($user);  // Connecte auto
        }

        $path = $request->file('file')->store('books', 'public');
        Book::create(array_merge($request->only(['title', 'author', 'description', 'niveau_etude', 'module', 'tutoriel']), [
            'file_path' => $path, 'user_id' => $user->id
        ]));

        return redirect()->route('books.index')->with('success', 'Document soumis !');
    }
}