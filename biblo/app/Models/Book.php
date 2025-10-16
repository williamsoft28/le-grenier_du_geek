<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'description', 'file_path', 'niveau_etude', 'module', 'tutoriel', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Recherche étendue (titre, auteur, niveau, module)
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('niveau_etude', 'like', "%{$search}%")
              ->orWhere('module', 'like', "%{$search}%");
        });
    }
}