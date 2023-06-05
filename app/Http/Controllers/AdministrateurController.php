<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdministrateurController extends Controller

{
    public function formulaire()
    {
        return view('inscription');
    }

    public function inscription(Request $request)
    {
        // Valider les champs du formulaire
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('inscription')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Enregistrer l'utilisateur dans la base de données
        $user = new Administrateur;
        $user->nom_admin = $request->input('name');
        $user->prenom_admin = $request->input('prenom');
        $user->email_admin = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Rediriger vers la page de connexion avec un message de succès
        return redirect('welcome')->with('success', 'Votre compte a été créé avec succès !');
    }



}