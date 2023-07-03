<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Tache;
use App\Models\Etape;
use App\Models\Culture;

class EtapeController extends Controller
{
    public function liste_etape()
    {
        $etapes = Etape::all();
        return view('etapes.liste_etape', compact('etapes'));
    }


    public function creer_etape(Request $request, $id)
    {
        $culture = Culture::findOrFail($id);
        
        $etapes = $culture->etapes;
        $cultures = Culture::all();
        
        return view('etapes.creer_etape', compact('etapes','cultures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'culture' => 'required',
            'nom' => 'required',
            'description' => 'required',
            'date_debut_etape' => 'required',
            'date_fin_etape' => 'required',
            'duree_etape' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', 

        ]);


        if($request->hasfile('image'))
        {
            $file = $request->file("image");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/etapes/', $filename);
            $image ='uploads/etapes/' .$filename;
        }

        $etape = Etape::create([
            'culture_id' => $request->culture,
            'nom_etape' => $request->nom,
            'description_etape' => $request->description,
            'date_debut_etape' => $request->date_debut_etape,
            'date_fin_etape' => $request->date_fin_etape,
            'duree_etape' => $request->duree_etape,
            'image_etape' => $image,
        ]);


        
        // Redirection ou affichage d'un message de succès
        return redirect()->back()->with('success', 'Étape créée avec succès pour la culture ');
    }

    public function details_etape($id)
    {
        $etape = Etape::findOrFail($id);
        
        $culture = Culture::with('etapes')->findOrFail($id);
        return view('etapes.details_etape', compact('etape'));
    }

    

    public function destroy($id)
    {
        $etape = Etape::findOrFail($id);
        $etape->delete();

        return redirect('details_culture')->with('success', 'etape supprimée avec succès!');
    }


    public function modifier_etape($id){

        $etapes = Etape::find($id);
        return view('etapes.modifier_etape', compact('etapes'));
       }
    
       public function modifier_etape_traitement(Request $request, $id){
            $request->validate([
                'culture' => 'required',
                'nom' => 'required',
                'description' => 'required',
                'date_debut_etape' => 'required',
                'date_fin_etape' => 'required',
                'duree_etape' => 'required',
            ]);
            $etape = Etape::find($request->id);
                
                $etape->culture_id = $request->input('etape');
                $etape->nom_etape = $request->input('nom_etape');
                $etape->description_etape = $request->input('descriptionetape');
                $etape->date_debut_etape = $request->input('date_debut_etape');
                $etape->date_fin_etape = $request->input('date_fin_etape');
                $etape->duree_etape = $request->input('duree_etape');
            $etape->save();
            return redirect()->route('etapes', $etape->id)->with('status', 'Modification effectuée avec succès');
       }

}