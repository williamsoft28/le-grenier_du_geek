<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;  // Ajout pour notifications (events Breeze)
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasRoles, Notifiable;  // Ajout Notifiable

    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password', 'filiere', 'niveau_etude', 'universite'
    ];

    protected $hidden = ['password', 'remember_token'];  // Ajout remember_token pour login persistant

    protected function casts(): array  // Ajout pour Laravel 11+ : hash auto mdp
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper pour nom complet
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Créer un user basique pour upload anonyme
    public static function createGuest($data)
    {
        $data['password'] = Hash::make('temp_' . uniqid());  // MDP temp, à changer par email
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];  // Ajout pour name
        $user = self::create($data);
        $user->assignRole('user');
        return $user;
    }
}