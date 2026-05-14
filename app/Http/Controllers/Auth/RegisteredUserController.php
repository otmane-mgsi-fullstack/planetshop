<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller

{

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            // Les autres champs...
        ]);

        try {
            $user = \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
                // 1. Création de l'User
                $user = User::create([
                    'name' => $request->prenom . ' ' . $request->nom, // Combine prenom/nom si 'name' est requis
                    'email' => $request->email,
                    'role' => 'client',
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                ]);

                // 2. Création du Client
                // Note : Utilisez explicitement $user->id
                Client::create([
                    'user_id'      => $user->id,
                    'prenom'       => $request->prenom,
                    'nom'          => $request->nom,
                    'telephone'    => $request->telephone,
                    'adresse'      => $request->adresse,
                    'ville'        => $request->ville,
                    'pays'         => $request->pays,
                    'actif'        => true,
                ]);

                return $user;
            });

            \Illuminate\Support\Facades\Auth::login($user);
            return redirect()->route('store.index')->with('success', 'Votre compte a été créé avec succès !');

        } catch (\Exception $e) {
            // En cas d'erreur, on revient en arrière avec l'erreur précise
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création du profil : ' . $e->getMessage()]);
        }
    }
}
