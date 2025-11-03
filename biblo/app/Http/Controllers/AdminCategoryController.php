<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TeamTeaTime\Forum\Models\Category;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('title')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // <- la méthode create MUST exist et retourner la vue du formulaire
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Génération du slug unique
        $base = Str::slug($request->title);
        $slug = $base;
        $i = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $category = new Category();
        $category->title = $request->title;
        $category->slug = $slug;
        $category->description = $request->description ?? null;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée !');
    }
}
