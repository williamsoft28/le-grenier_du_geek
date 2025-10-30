<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TeamTeaTime\Forum\Models\Category;
use TeamTeaTime\Forum\Models\Thread;
use TeamTeaTime\Forum\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;

class ForumController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'showCategory', 'showThread']);  // Libre pour voir, auth pour actions
    }

    /**
     * Affiche la liste des catégories du forum.
     */
    public function index()
    {
        $categories = Category::withCount(['threads as threads_count', 'posts as posts_count'])
                              ->orderBy('title')
                              ->get();

        return view('forum.index', compact('categories'));
    }

    /**
     * Affiche les discussions d'une catégorie.
     */
    public function showCategory(Category $category)
    {
        $threads = $category->threads()
                            ->with(['author', 'posts' => function ($query) {
                                $query->latest()->limit(1);  // Dernier post pour aperçu
                            }])
                            ->latest()
                            ->paginate(10);

        return view('forum.category', compact('category', 'threads'));
    }

    /**
     * Form pour créer une nouvelle discussion (global).
     */
    public function createThread()
    {
        $categories = Category::orderBy('title')->get();
        return view('forum.create-thread', compact('categories'));
    }

    /**
     * Stocke une nouvelle discussion (form global).
     */
    public function storeThread(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:forum_categories,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
        ]);

        $category = Category::findOrFail($request->category_id);

        $thread = $category->threads()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),  // Auto-slug pour URL
            'author_id' => Auth::id(),
            'locked' => false,
        ]);

        $thread->posts()->create([
            'author_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->route('forum.category.show', $category)
                         ->with('success', 'Votre discussion a été créée dans ' . $category->title . ' !');
    }

    /**
     * Affiche une discussion spécifique.
     */
    public function showThread(Thread $thread)
    {
        $thread->load(['category', 'author', 'posts.author']);

        // Incrémente vues
        $thread->increment('views');

        return view('forum.thread', compact('thread'));
    }

    /**
     * Ajoute un post/réponse à une discussion.
     */
    public function storePost(Request $request, Thread $thread)
    {
        $request->validate([
            'body' => 'required|string|min:5',
        ]);

        Post::create([
            'thread_id' => $thread->id,
            'author_id' => Auth::id(),
            'body' => $request->body,
        ]);

        $thread->touch();  // Met à jour timestamp

        return redirect()->route('forum.thread.show', $thread)
                         ->with('success', 'Votre réponse a été ajoutée !');
    }

    // ADMIN : Créer catégorie
    public function createCategory()
    {
        return view('forum.admin.create-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|unique:forum_categories,slug',
        ]);

        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ]);

        return redirect()->route('forum.index')->with('success', 'Catégorie créée !');
    }
}