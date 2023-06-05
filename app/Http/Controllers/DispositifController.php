<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Dispositif;


class DispositifController extends Controller
{
    public function liste_dispositif()
    {
        $dispositifs = Dispositif::all();
        return view('dispositifs.liste_dispositif', compact('dispositifs'));
    }

    public function creer_dispositif()
    {
        $dispositifs = Dispositif::all();
        return view('dispositifs.creer_dispositif', compact('dispositifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_dispositif'=>'required',
            'description_dispositif'=>'required',

        ]);
        $dispositif = Dispositif::create([
        'nom_dispositif' => $request->nom_dispositif,
        'description_dispositif' => $request->description_dispositif,
        ]);

        return redirect()->route('dispositifs', $dispositif->id)->with('success', 'dispositif ajoutée avec succès!');
    }

    public function details_dispositif($id)
    {
        $dispositif = Dispositif::findOrFail($id);
        return view('dispositifs.details_dispositif', compact('dispositif'));
    }

    

    public function destroy($id)
    {
        $dispositif = Dispositif::findOrFail($id);
        $dispositif->delete();

        return redirect()->route('dispositifs')->with('success', 'dispositif supprimée avec succès!');
    }


    public function modifier_dispositif($id){

        $dispositifs = Dispositif::find($id);
        return view('dispositifs.modifier_dispositif', compact('dispositifs'));
       }
    
       public function modifier_dispositif_traitement(Request $request, $id){
            $request->validate([
                'nom_dispositif'=>'required',
                'description_dispositif'=>'required',
            ]);
            $dispositif = Dispositif::find($request->id);

            $dispositif->nom_dispositif = $request->input('nom_dispositif');
            $dispositif->description_dispositif = $request->input('description_dispositif');
            $dispositif->save();
            return redirect()->route('dispositifs', $dispositif->id)->with('status', 'Modification effectuée avec succès');
       }
    


}