<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
| Application "Le Grenier du Geek"
| - Gestion des livres / ressources
| - Forum communautaire
| - Chatbot intelligent
| - Gestion des profils utilisateurs
|--------------------------------------------------------------------------
*/

// 🏠 Accueil → redirection vers la section livres
Route::get('/', fn() => redirect('/books'));

// 🧭 Tableau de bord (réservé aux utilisateurs vérifiés)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 👤 Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 📚 Gestion des livres / ressources
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books.index');
    Route::get('/books/create', 'create')->name('books.create');
    Route::post('/books', 'store')->name('books.store');
    Route::get('/books/{book}', 'show')->name('books.show');
    Route::get('/explore', 'explore')->name('explore');
});

// 💬 Forum communautaire (prefix forum, auth pour actions)
Route::prefix('forum')->name('forum.')->group(function () {
    // Accès libre pour voir
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/category/{category}', [ForumController::class, 'showCategory'])->name('category.show');
    Route::get('/thread/{thread}', [ForumController::class, 'showThread'])->name('thread.show');

    // Auth required pour créer/reply
    Route::middleware('auth')->group(function () {
        Route::get('/thread/create', [ForumController::class, 'createThread'])->name('thread.create');
        Route::post('/thread', [ForumController::class, 'storeThread'])->name('thread.store');
        Route::post('/thread/{thread}/reply', [ForumController::class, 'storePost'])->name('thread.reply');
    });

    // Admin only pour gestion catégories
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/categories/create', [ForumController::class, 'createCategory'])->name('categories.create');
        Route::post('/categories', [ForumController::class, 'storeCategory'])->name('categories.store');
    });
});

// 🤖 Chatbot
// 🤖 Chatbot
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index'); // Page chat
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask'); // Réponse bot

// 🔐 Authentification
require __DIR__ . '/auth.php';