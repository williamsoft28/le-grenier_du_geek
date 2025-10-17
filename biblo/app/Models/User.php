<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password', 'filiere', 'niveau_etude', 'universite'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec les livres soumis par l'user
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Getter pour nom complet
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Créer un user basique pour upload anonyme
    public static function createGuest($data)
    {
        $data['password'] = Hash::make('temp_' . uniqid());
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $user = self::create($data);
        $user->assignRole('user');
        return $user;
    }
}