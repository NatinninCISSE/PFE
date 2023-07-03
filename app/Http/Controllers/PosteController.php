<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Poste;
use App\Models\Client;

class PosteController extends Controller
{
    public function liste_poste()
    {
        $postes = Poste::all();
        return view('postes.liste_poste', compact('postes'));
    }

    public function liste_poste_api()
    {
        $postes = Poste::all();
        return json_encode(Poste::all());
    }


    public function creer_poste()
    {
        $client = new Client;
        
        $postes = $client->postes;
        $clients = Client::all();
        
        return view('postes.creer_poste', compact('postes','clients'));
    }


    public function store(Request $request)
    {
        $request->validate([
            
            'client' => 'required',
            'contenu_poste' => 'required',
            'image'=>'required',
        ]);

        if($request->hasfile('image'))
        {
            $file = $request->file("image");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/postes/', $filename);
            $image ='uploads/postes/' .$filename;
        }



        $poste = Poste::create([
            
            'client_id' => $request->client,
            'objet_poste' => $request->objet_poste,
            'image_client' => $image,
        ]);


        return redirect()->route('postes', $poste->id)->with('success', 'poste ajoutée avec succès!');
    }

    
    public function creer_poste_api(Request $request)
    {
        $request->validate([
            
            // 'client' => 'required',
            'contenu_poste' => 'required',
            'image_poste'=>'required',
        ]);

        if($request->hasfile('image_poste'))
        {
            $file = $request->file("image_poste");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/postes/', $filename);
            $image ='uploads/postes/' .$filename;
        }



        $poste = Poste::create([
            
            'client_id' => 3,
            'contenu_poste' => $request->contenu_poste,
            'image_poste' => $image,
        ]);

        json_encode($poste);


        // return redirect()->route('postes', $poste->id)->with('success', 'poste ajoutée avec succès!');
    }


    public function details_poste($id)
    {
        $poste = Poste::findOrFail($id);
        
        $client = Client::with('postes')->findOrFail($id);
        return view('postes.details_poste', compact('poste'));
    }
    

    public function destroy($id)
    {
        $poste = Poste::findOrFail($id);
        $poste->delete();

        return redirect()->route('postes')->with('success', 'poste supprimée avec succès!');
    }



    public function modifier_poste($id){

        $postes = Poste::find($id);
        $clients = Client::all();
        return view('postes.modifier_poste', compact('postes','clients'));
       }
    
       public function modifier_poste_traitement(Request $request, $id){
            $request->validate([
            'client' => 'required',
            'contenu_poste' => 'required',
            'image_culture' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
            $poste = Poste::find($request->id);
            
            $poste->client_id = $request->input('poste');
            $poste->contenu_poste = $request->input('contenu_poste');
            $poste->image = $request->input('image');
            $poste->save();
            return redirect()->route('postes', $poste->id)->with('status', 'Modification effectuée avec succès');
       }
    


}