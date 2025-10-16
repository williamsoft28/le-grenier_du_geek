<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Créer rôles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Créer un admin de test
        $admin = User::create([
            'name' => 'Admin Test',
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'filiere' => 'Informatique',
            'niveau_etude' => 'Master',
            'universite' => 'Univ Test',
        ]);
        $admin->assignRole('admin');
    }
}