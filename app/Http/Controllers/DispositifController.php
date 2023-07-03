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
            'nom_dispositif' => 'required',
            'description_dispositif' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);
    
        $image = null; // Initialisation de la variable $image à null
    
        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/dispositifs/', $filename);
            $image = 'uploads/dispositifs/' . $filename;
        }
    
        $dispositif = Dispositif::create([
            'nom_dispositif' => $request->nom_dispositif,
            'description_dispositif' => $request->description_dispositif,
            'image_dispositif' => $image,
        ]);
    
        return redirect()->route('dispositifs', $dispositif->id)->with('success', 'Dispositif ajouté avec succès!');
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
            ]);


            if ($request->hasFile('image')) {
                $file = $request->file("image");
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/dispositifs/', $filename);
                $image = 'uploads/dispositifs/' . $filename;
            }

            $dispositif = Dispositif::find($request->id);

            $dispositif->nom_dispositif = $request->input('nom_dispositif');
            $dispositif->description_dispositif = $request->input('description_dispositif');
            $dispositif->image_dispositif = $request->input('image_dispositif');
            $dispositif->save();
            return redirect()->route('dispositifs', $dispositif->id)->with('status', 'Modification effectuée avec succès');
       }
    


}