<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    public function index(){
        $clients=Client::all();
        return view('Admin.client.index')->with('clients',$clients);
    }

    public function Ajouter_etudiant()
    {
        return view('Admin.client.create');
    }
    public function liste_etudiant(){
        $clients = Client::all();
        return view('Admin.client.index', compact('clients'));
    }
    public function Ajouter_traitement(Request $request){
        $request->validate([
            'name'=>'required|max:20',
            'prenom'=>'required|max:20',
            'numero'=>'required|max:10',
            'adresse'=>'required',
            'mdp'=>'required|max:5',
            'mail'=>'required',
            'date'=>'required|max:10',
        ]);
        $client = new Client();
        $client->nom_client = $request->name;
        $client->prenom_client = $request->prenom;
        $client->numero_client = $request->numero;
        $client->adresse_client = $request->adresse;
        $client->MDP_client = Hash::make($request->mdp);
        $client->mail_client = $request->mail;
        $client->Datecreacompte_client = $request->date;
        $client->save();
        return redirect('/index')->with('status', 'Ajout effectué avec succès');
    }

   public function edit_etudiant($id){

    $clients = Client::find($id);
    return view('Admin.client.edit', compact('clients'));
   }

   public function edit_traitement(Request $request){
        $request->validate([
            'name'=>'required|max:20',
            'prenom'=>'required|max:20',
            'numero'=>'required|max:10',
            'adresse'=>'required',
            'mdp'=>'required|max:5',
            'mail'=>'required',
            'date'=>'required|max:10',
        ]);
        $client = Client::find($request->id);
        $client->nom_client = $request->name;
        $client->prenom_client = $request->prenom;
        $client->numero_client = $request->numero;
        $client->adresse_client = $request->adresse;
        $client->MDP_client = Hash::make($request->mdp);
        $client->mail_client = $request->mail;
        $client->Datecreacompte_client = $request->date;
        $client->update();
        return redirect('/index')->with('status', 'Modification effectuée avec succès');
   }
   public function delete_etudiant($id){
        $clients = Client::find($id);
        $clients->delete();
        return redirect('/index')->with('status', 'Le client a bien été supprimé');
   }

    
    
     
}

