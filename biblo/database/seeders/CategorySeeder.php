<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Exécute le seeder pour insérer des catégories par défaut.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Général',
                'slug' => Str::slug('Général'),
            ],
            [
                'name' => 'Développement',
                'slug' => Str::slug('Développement'),
            ],
            [
                'name' => 'Réseau & Sécurité',
                'slug' => Str::slug('Réseau Sécurité'),
            ],
            [
                'name' => 'Bases de Données',
                'slug' => Str::slug('Bases de Données'),
            ],
        ]);
    }
}
