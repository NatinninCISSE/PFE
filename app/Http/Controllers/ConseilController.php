<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\conseil;
use App\Models\Etape;

class ConseilController extends Controller
{
    public function liste_conseil()
    {
        $conseils = Conseil::all();
        return view('conseils.liste_conseil', compact('conseils'));
    }


    public function creer_conseil()
    {
        $etape = new Etape;
        
        $conseils = $etape->conseils;
        $etapes = Etape::all();
        
        return view('conseils.creer_conseil', compact('conseils','etapes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            
            'etape' => 'required',
            'contenu_conseil' => 'required',
        ]);
        $conseil = Conseil::create([
            
            'etape_id' => $request->etape,
            'contenu_conseil' => $request->objet_conseil,
        ]);


        return redirect()->route('conseils', $conseil->id)->with('success', 'conseil ajoutée avec succès!');
    }


    public function details_conseil($id)
    {
        $conseil = Conseil::findOrFail($id);
        
        $etape = Etape::with('conseils')->findOrFail($id);
        return view('conseils.details_conseil', compact('conseil'));
    }
    

    public function destroy($id)
    {
        $conseil = Conseil::findOrFail($id);
        $conseil->delete();

        return redirect()->route('conseils')->with('success', 'conseil supprimée avec succès!');
    }



    public function modifier_conseil($id){

        $conseils = Conseil::find($id);
        $etapes = Etape::all();
        return view('conseils.modifier_conseil', compact('conseils','etapes'));
       }
    
       public function modifier_conseil_traitement(Request $request, $id){
            $request->validate([
            'etape' => 'required',
            'contenu_conseil' => 'required',
            ]);
            $conseil = Conseil::find($request->id);
            
            $conseil->etape_id = $request->input('conseil');
            $conseil->contenu_conseil = $request->input('contenu_conseil');
            $conseil->save();
            return redirect()->route('conseils', $conseil->id)->with('status', 'Modification effectuée avec succès');
       }
    


}