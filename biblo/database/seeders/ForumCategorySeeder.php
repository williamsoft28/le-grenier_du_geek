<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TeamTeaTime\Forum\Models\Category;

class ForumCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => 'IA & Machine Learning',
                'description' => 'Discussions sur algorithmes, deep learning, NLP et applications IA.',
                'slug' => 'ia'
            ],
            [
                'title' => 'Développement Web',
                'description' => 'Échanges sur HTML, JavaScript, frameworks (React, Vue) et front/back-end.',
                'slug' => 'web'
            ],
            [
                'title' => 'Bases de Données',
                'description' => 'SQL, NoSQL, modélisation, optimisation et outils comme MongoDB.',
                'slug' => 'bd'
            ],
            [
                'title' => 'Sécurité Informatique',
                'description' => 'Cryptographie, cybersécurité, audits, réseaux sécurisés et bonnes pratiques.',
                'slug' => 'securite'
            ],
            [
                'title' => 'Programmation Générale',
                'description' => 'Python, Java, Rust, langages et bonnes pratiques de code.',
                'slug' => 'prog'
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}