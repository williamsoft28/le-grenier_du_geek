<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password', 'filiere', 'niveau_etude', 'universite'
    ];

    protected $hidden = ['password'];

    // Helper pour nom complet
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Créer un user basique pour upload anonyme
    public static function createGuest($data)
    {
        $data['password'] = Hash::make('temp_' . uniqid());  // MDP temp, à changer par email
        $user = self::create($data);
        $user->assignRole('user');
        return $user;
    }
}