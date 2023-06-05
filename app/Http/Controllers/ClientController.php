<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Client;
use App\Models\Dispositif;


class ClientController extends Controller
{
    public function liste_client()
    {
        $clients = Client::all();
        return view('clients.liste_client', compact('clients'));
    }


    public function creer_client()
    {
        $dispositif = new Dispositif;
        
        $clients = $dispositif->clients;
        $dispositifs = Dispositif::all();
        
        return view('clients.creer_client', compact('clients','dispositifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dispositif' => 'required',
            'nom_client'=>'required|max:20',
            'prenom_client'=>'required|max:20',
            'numero_client'=>'required|max:10',
            'adresse_client'=>'required',
            'password_client'=>'required|max:5',
            'mail_client'=>'required',

        ]);
        $client = Client::create([
        'dispositif_id' => $request->dispositif,
        'nom_client' => $request->nom_client,
        'prenom_client' => $request->prenom_client,
        'numero_client' => $request->numero_client,
        'adresse_client' => $request->adresse_client,
        'password_client' => Hash::make($request->password_client),
        'mail_client' => $request->mail_client,
        ]);

        return redirect()->route('clients', $client->id)->with('success', 'client ajoutée avec succès!');
    }

    public function details_client($id)
    {
        $client = Client::findOrFail($id);
        
        $dispositif = Dispositif::with('clients')->findOrFail($id);
        return view('clients.details_client', compact('client'));
    }

    

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients')->with('success', 'client supprimée avec succès!');
    }


    public function modifier_client($id){

        $clients = Client::find($id);
        return view('clients.modifier_client', compact('clients'));
       }
    
       public function modifier_client_traitement(Request $request, $id){
            $request->validate([
                
                'dispositif' => 'required',
                'nom_client'=>'required|max:20',
                'prenom_client'=>'required|max:20',
                'numero_client'=>'required|max:10',
                'adresse_client'=>'required',
                'password_client'=>'required|max:5',
                'mail_client'=>'required',
            ]);
            $client = Client::find($request->id);
            
            $client->dispositif_id = $request->input('client');
            $client->nom_client = $request->input('nom_client');
            $client->prenom_client = $request->input('prenom_client');
            $client->numero_client = $request->input('numero_client');
            $client->adresse_client = $request->input('adresse_client');
            $client->password_client = Hash::make($request->input('password_client'));
            $client->mail_client = $request->input('mail_client');
            $client->save();
            return redirect()->route('clients', $client->id)->with('status', 'Modification effectuée avec succès');
       }
    


}