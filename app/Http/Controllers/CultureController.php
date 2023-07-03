<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Culture;
use App\Models\Etape;

class CultureController extends Controller
{
    public function liste_culture()
    {
        $cultures = Culture::all();
        return view('cultures.liste_culture', compact('cultures'));
    }

    public function creer_culture()
    {
        $etapes = Etape::all();
        return view('cultures.creer_culture', compact('etapes'));
    }

    
    public function liste_culture_api()
    {
        return json_encode(Culture::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);
    
        if($request->hasfile('image'))
        {
            $file = $request->file("image");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/cultures/', $filename);
            $image ='uploads/cultures/' .$filename;
        }
    
        $culture = Culture::create([
            'nom_culture' => $request->nom,
            'description_culture' => $request->description,
            'image_culture' => $image, // Enregistrement du chemin de l'image
        ]);
    
        return redirect()->route('cultures', $culture->id)->with('success', 'Culture ajoutée avec succès!');
    }

    public function details_culture($id)
    {
        $culture = Culture::findOrFail($id);
        $etapes = Etape::where('culture_id', $id)->with('cultures')->get();

        return view('cultures.details_culture', compact('etapes','culture'));
    }

    

    public function destroy($id)
    {
        $culture = Culture::findOrFail($id);
        $culture->delete();

        return redirect()->route('cultures')->with('success', 'Culture supprimée avec succès!');
    }

    public function etapes ($id) {

        $etapes = Etape::where('column_name', $id)->get();
        

    }
    

    public function modifier_culture($id){

        $cultures = Culture::find($id);
        return view('cultures.modifier_culture', compact('cultures'));
       }
    
       public function modifier_culture_traitement(Request $request, $id){
            $request->validate([
                'nom_culture'=>'required|max:20',
                'description_culture'=>'required|max:200',
                'image_culture' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            if($request->hasfile('image'))
        {
            $file = $request->file("image");
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/cultures/', $filename);
            $image ='uploads/cultures/' .$filename;
        }
            $culture = Culture::find($request->id);
            
            $culture->nom_culture = $request->input('nom_culture');
            $culture->description_culture = $request->input('description_culture');
            $culture->image_culture = $request->input('image_culture');
            $culture->save();
            return redirect()->route('cultures', $culture->id)->with('status', 'Modification effectuée avec succès');

       }
    
}