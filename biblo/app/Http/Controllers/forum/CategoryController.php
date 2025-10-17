<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Thread;

class CategoryController extends Controller
{
    /**
     * Affiche la liste de toutes les catégories du forum
     */
    public function index()
    {
        // Récupère toutes les catégories
        $categories = Category::all();

        // Retourne la vue forum.index
        return view('forum.index', compact('categories'));
    }

    /**
     * Affiche les threads (discussions) d’une catégorie donnée
     */
    public function show($slug)
    {
        // Recherche la catégorie via son slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Récupère tous les threads liés à cette catégorie
        $threads = Thread::where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        // Retourne la vue forum.category avec les données
        return view('forum.category', compact('category', 'threads'));
    }
}
