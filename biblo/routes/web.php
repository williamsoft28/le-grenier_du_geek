<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/books'));

// Auth Breeze par défaut : login/register avec nos custom vues
require __DIR__.'/auth.php';

// Livres : index/show anonymes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Upload : nécessite auth ou guest form
Route::middleware('auth')->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
});
Route::post('/books', [BookController::class, 'store'])->name('books.store');  // Gère guest

// Forum et Chat : auth only
Route::middleware('auth')->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/chat', [ChatController::class, 'handle'])->name('chat');
});