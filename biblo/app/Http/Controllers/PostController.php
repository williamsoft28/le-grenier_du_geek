<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function store(Request $request, Thread $thread)
    {
        $data = $request->validate(['body' => 'required|string|min:2']);
        $post = $thread->posts()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);
        return redirect()->route('threads.show', $thread)->with('success','Réponse publiée.');
    }

    // edit/update/destroy : author checks
}
