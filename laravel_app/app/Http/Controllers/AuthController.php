<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'function' => 'required|string|in:etudiant,professeur,developpeur',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->function = $request->function;
        $user->save();

        return response()->json(['message' => 'Inscription réussie'], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        error_log("Login Attempt: " . print_r($credentials, true)); // Ajoutez cette ligne pour déboguer les informations d'identification

        if (Auth::attempt($credentials)) {
            // L'authentification a réussi
            return response()->json(['message' => 'Connexion réussie'], 200);
        } else {
            // L'authentification a échoué
            error_log("Login Failed"); // Ajoutez cette ligne pour déboguer l'échec de connexion
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }
    }

}
