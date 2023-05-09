<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class InscriptionController extends Controller
{
    public function formulaire()
    {
        return view('inscription');
    }

    public function inscription(Request $request)
    {
        // Valider les champs du formulaire
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('inscription')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Enregistrer l'utilisateur dans la base de données
        $user = new User;
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Rediriger vers la page de connexion avec un message de succès
        return redirect('login')->with('success', 'Votre compte a été créé avec succès !');
    }
}

