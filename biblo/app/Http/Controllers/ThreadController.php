<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Category;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    /**
     * Affiche le formulaire de création d’un thread.
     */
    public function create()
    {
        // On récupère toutes les catégories pour le select
        $categories = Category::all();

        return view('forum.threads.create', compact('categories'));
    }

    /**
     * Stocke le nouveau thread dans la base.
     */
   public function store(Request $request)
{
    $category = Category::where('slug', $request->category_slug)->firstOrFail();

    $thread = new Thread();
    $thread->title = $request->title;
    $thread->excerpt = Str::limit($request->content, 100);
    $thread->user_id = auth()->id();
    $thread->category_id = $category->id;
    $thread->save();

    Post::create([
        'thread_id' => $thread->id,
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return redirect()->route('forum.thread.show', $thread->slug);
}

    /**
     * Affiche un thread.
     */
    public function show(Thread $thread)
    {
        return view('forum.threads.show', compact('thread'));
    }
}
