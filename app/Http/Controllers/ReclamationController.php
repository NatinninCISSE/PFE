<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Reclamation;
use App\Models\Dispositif;

class ReclamationController extends Controller
{
    public function liste_reclamation()
    {
        $reclamations = Reclamation::all();
        return view('reclamations.liste_reclamation', compact('reclamations'));
    }


    public function creer_reclamation()
    {
        $dispositif = new Dispositif;
        
        $reclamations = $dispositif->reclamations;
        $dispositifs = Dispositif::all();
        
        return view('reclamations.creer_reclamation', compact('reclamations','dispositifs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            
            'dispositif' => 'required',
            'objet_reclamation' => 'required',
            'description_reclamation' => 'required',
        ]);

        $reclamation = Reclamation::create([
            
            'dispositif_id' => $request->dispositif,
            'objet_reclamation' => $request->objet_reclamation,
            'description_reclamation' => $request->description_reclamation,
        ]);


        return redirect()->route('reclamations', $reclamation->id)->with('success', 'reclamation ajoutée avec succès!');
    }


    public function details_reclamation($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        
        $dispositif = Dispositif::with('reclamations')->findOrFail($id);
        return view('reclamations.details_reclamation', compact('reclamation'));
    }
    

    public function destroy($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $reclamation->delete();

        return redirect()->route('reclamations')->with('success', 'reclamation supprimée avec succès!');
    }



    public function modifier_reclamation($id){

        $reclamations = Reclamation::find($id);
        return view('reclamations.modifier_reclamation', compact('reclamations'));
       }
    
       public function modifier_reclamation_traitement(Request $request, $id){
            $request->validate([
                'dispositif' => 'required',
                'objet_reclamation'=>'required|max:20',
                'description_reclamation'=>'required|max:200',
            ]);
            $reclamation = Reclamation::find($request->id);
            
            $reclamation->dispositif_id = $request->input('reclamation');
            $reclamation->objet_reclamation = $request->input('objet_reclamation');
            $reclamation->description_reclamation = $request->input('description_reclamation');
            $reclamation->save();
            return redirect()->route('reclamations', $reclamation->id)->with('status', 'Modification effectuée avec succès');
       }
    


}