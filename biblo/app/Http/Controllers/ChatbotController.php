<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Ou use GuzzleHttp\Client;

class ChatbotController extends Controller
{
    // Nouvelle méthode pour afficher la page du chatbot (GET /chatbot)
    public function index()
    {
        return view('chatbot.index'); // Assure-toi que le fichier est dans resources/views/chatbot.blade.php
    }

    // Votre méthode existante pour les questions (POST /chatbot/ask)
    public function ask(Request $request)
    {
        $request->validate(['question' => 'required|string|max:500']);

        $question = urlencode($request->input('question'));

        // Recherche via DuckDuckGo API
        $response = Http::get('https://api.duckduckgo.com/', [
            'q' => $question,
            'format' => 'json',
            'no_html' => 1,
            'skip_disambig' => 1,
            'no_redirect' => 1
        ]);

        $data = $response->json();

        if ($data['Abstract'] ?? false) {
            $answer = $data['Abstract'];
            $source = $data['AbstractURL'] ?: 'https://duckduckgo.com/?q=' . $question;
        } else {
            $answer = "Je n'ai pas trouvé de réponse précise. Voici un lien pour creuser :";
            $source = "https://www.google.com/search?q=" . $question;
        }

        return response()->json([
            'answer' => $answer,
            'source' => $source
        ]);
    }
}