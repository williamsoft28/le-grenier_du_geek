<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Forum\CategoryController;
use App\Http\Controllers\Forum\ThreadController;
use App\Http\Controllers\Forum\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
|
| Routes principales de l'application "Le Grenier du Geek"
| - Espace livres / ressources
| - Forum communautaire
| - Gestion du profil utilisateur
|
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

// 💬 Forum communautaire
Route::prefix('forum')->name('forum.')->group(function () {

    // 📁 Catégories
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

    // 🧵 Discussions (threads)
    Route::middleware('auth')->group(function () {
        Route::get('/threads/nouveau', [ThreadController::class, 'create'])->name('threads.create');
        Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
        Route::post('/thread/{thread:slug}/reply', [PostController::class, 'store'])->name('posts.store');
    });

    Route::get('/thread/{thread:slug}', [ThreadController::class, 'show'])->name('threads.show');
});

// 🔐 Authentification (Laravel Breeze / Jetstream)
require __DIR__.'/auth.php';
