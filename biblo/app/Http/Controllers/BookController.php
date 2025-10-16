<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;  // Ajout pour middleware

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $books = Book::search($request->q ?? '')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('books.create');
        }
        $guestData = session('guest_data', []);
        return view('books.create-guest', compact('guestData'));
    }

    public function store(Request $request)
    {
        $isGuest = $request->has('guest');

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,epub|max:10240',
            'niveau_etude' => 'required|string|max:100',
            'module' => 'nullable|string|max:255',
            'tutoriel' => 'nullable|string',
            'first_name' => ['required_if:guest,true', 'string', 'max:255'],
            'last_name' => ['required_if:guest,true', 'string', 'max:255'],
            'email' => ['required_if:guest,true', 'email', Rule::unique('users', 'email')],
            'filiere' => 'nullable|string|max:255',
            'universite' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        if ($isGuest) {
            session(['guest_data' => $request->only(['first_name', 'last_name', 'email', 'filiere', 'universite'])]);
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'filiere' => $request->filiere,
                'niveau_etude' => $request->niveau_etude,
                'universite' => $request->universite,
            ];
            $user = User::createGuest($userData);
            Auth::login($user);
        }

        $path = $request->file('file')->store('books', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'file_path' => $path,
            'niveau_etude' => $request->niveau_etude,
            'module' => $request->module,
            'tutoriel' => $request->tutoriel,
            'user_id' => $user->id,
        ]);

        return redirect()->route('books.index')->with('success', 'Document soumis !');
    }
}