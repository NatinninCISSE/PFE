<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Tache;
use App\Models\Etape;

class TacheController extends Controller
{
    public function liste_tache()
    {
        $taches = Tache::all();
        return view('taches.liste_tache', compact('taches'));
    }


    public function creer_tache(Request $request, $id)
    {
        $etape = Etape::findOrFail($id);
        $taches = $etape->taches;
        $taches = Tache::all();
        $etapes = Etape::all();
        return view('taches.creer_tache', compact('taches', 'etape','etapes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'etape'=> 'required',
            'nom' => 'required',
            'description' => 'required',
        ]);

        $tache = Tache::create([
            'etape_id' => $request->etape,
            'nom_tache' => $request->nom,
            'description_tache' => $request->description,
        ]);


        return redirect()->route('taches', $tache->id)->with('success', 'tache ajoutée avec succès!');
    }



    public function details_tache($id)
    {
        $taches = Tache::findOrFail($id);
        $tache = $taches;
        $etape = Etape::with('taches')->findOrFail($id);
        // dd($etape);
        return view('taches.details_tache', compact('taches','etape','tache'));
    }

    

    public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();

        return redirect()->route('taches')->with('success', 'tache supprimée avec succès!');
    }


    



    






    public function modifier_tache($id){

        $taches = Tache::find($id);
        return view('taches.modifier_tache', compact('taches'));
       }
    
       public function modifier_tache_traitement(Request $request, $id){
            $request->validate([
                'nom_tache'=>'required|max:20',
                'description_tache'=>'required|max:200',
            ]);
            $tache = Tache::find($request->id);
            
            $tache->nom_tache = $request->input('nom_tache');
            $tache->description_tache = $request->input('description_tache');
            $tache->save();
            return redirect()->route('taches', $tache->id)->with('status', 'Modification effectuée avec succès'); 
       }
    


}