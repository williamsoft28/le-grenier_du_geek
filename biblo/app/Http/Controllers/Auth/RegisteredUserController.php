<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;  // Pour rôles

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'filiere' => ['nullable', 'string', 'max:255'],
            'niveau_etude' => ['required', 'string', 'max:255'],
            'universite' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,  // Combine pour 'name'
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'filiere' => $request->filiere,
            'niveau_etude' => $request->niveau_etude,
            'universite' => $request->universite,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        $user->assignRole('user');  // Rôle par défaut (crée le rôle si pas là)

        return redirect(RouteServiceProvider::HOME);
    }
}